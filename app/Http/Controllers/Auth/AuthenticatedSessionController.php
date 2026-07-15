<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\User;
use App\Mail\OtpMail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->ensureIsNotRateLimited();

        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            RateLimiter::clear($request->throttleKey());

            // Check if this is a trusted device (Remember me cookie exists for 30 days)
            if ($request->cookie('trusted_device_user_' . $user->id) === '1') {
                Auth::login($user, $request->boolean('remember'));
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            // Generate 6-digit OTP
            $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            $user->update([
                'otp_code' => Hash::make($otpCode),
                'otp_expires_at' => now()->addMinutes(5),
            ]);

            // Send OTP email
            Mail::to($user->email)->send(new OtpMail($otpCode));

            // Store user ID and timestamp temporarily in session
            $request->session()->put('otp_user_id', $user->id);
            Cache::put('last_otp_sent_at_' . $user->id, now()->timestamp, 60);
            $request->session()->put('remember_me', $request->boolean('remember'));

            return redirect()->route('otp.show');
        }

        RateLimiter::hit($request->throttleKey(), 900); // 15 mins lockout

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Display the OTP verification view.
     */
    public function showOtp(Request $request): View|RedirectResponse
    {
        $userId = $request->session()->get('otp_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $lastSent = Cache::get('last_otp_sent_at_' . $userId, 0);
        $cooldown = max(0, 60 - (now()->timestamp - $lastSent));

        return view('auth.otp', compact('cooldown'));
    }

    /**
     * Verify the incoming OTP code.
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $throttleKey = 'otp|' . $request->ip();
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            abort(429, 'Too Many Attempts.');
        }

        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $userId = $request->session()->get('otp_user_id');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['email' => 'Sesi login telah habis.']);
        }

        $user = User::find($userId);

        if (!$user || !Hash::check($request->otp_code, $user->otp_code ?? '') || now()->greaterThan($user->otp_expires_at)) {
            RateLimiter::hit($throttleKey, 60);
            return back()->withErrors(['otp_code' => 'Kode OTP salah atau sudah kedaluwarsa.']);
        }

        RateLimiter::clear($throttleKey);
        
        // Clear OTP fields
        $user->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);

        // Login user
        $remember = $request->session()->get('remember_me', false);
        Auth::login($user, $remember);

        // Queue trusted device cookie for 30 days if remember me was checked
        if ($remember) {
            Cookie::queue('trusted_device_user_' . $user->id, '1', 60 * 24 * 30);
        }

        $request->session()->forget(['otp_user_id', 'remember_me']);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }

    /**
     * Resend the OTP code.
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $userId = $request->session()->get('otp_user_id');
        if (!$userId) {
            return redirect()->route('login');
        }

        $lastSent = Cache::get('last_otp_sent_at_' . $userId, 0);
        if (now()->timestamp - $lastSent < 60) {
            return back()->withErrors(['otp_code' => 'Harap tunggu 1 menit sebelum meminta kode baru.']);
        }

        $user = User::find($userId);
        if (!$user) {
            return redirect()->route('login');
        }

        $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->update([
            'otp_code' => Hash::make($otpCode),
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        Mail::to($user->email)->send(new OtpMail($otpCode));
        Cache::put('last_otp_sent_at_' . $userId, now()->timestamp, 60);

        return back()->with('status', 'Kode OTP baru telah dikirim ke email Anda.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
