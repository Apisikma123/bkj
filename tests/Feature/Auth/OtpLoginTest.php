<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Models\Role;
use App\Mail\OtpMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Tests\TestCase;

class OtpLoginTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        Mail::fake();

        // Create standard roles
        $adminRole = Role::create(['name' => 'Super Admin', 'slug' => 'super-admin']);

        // Create user
        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@bkjgroup.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);
    }

    public function test_credentials_validation_triggers_otp_and_redirects()
    {
        $response = $this->post('/bkj-portal-access', [
            'email' => 'test@bkjgroup.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('otp.show'));
        $this->assertEquals($this->user->id, session('otp_user_id'));

        // Refresh user and assert OTP columns are updated
        $this->user->refresh();
        $this->assertNotNull($this->user->otp_code);
        $this->assertNotNull($this->user->otp_expires_at);

        // Assert mail was sent
        Mail::assertSent(OtpMail::class, function ($mail) {
            return $mail->hasTo('test@bkjgroup.com');
        });
    }

    public function test_invalid_credentials_does_not_trigger_otp()
    {
        $response = $this->post('/bkj-portal-access', [
            'email' => 'test@bkjgroup.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertNull(session('otp_user_id'));

        Mail::assertNothingSent();
    }

    public function test_accessing_otp_page_without_session_redirects_to_login()
    {
        $response = $this->get(route('otp.show'));
        $response->assertRedirect(route('login'));
    }

    public function test_correct_otp_logs_in_user()
    {
        // Setup temporary session and hash
        $otpRaw = '123456';
        $this->user->update([
            'otp_code' => Hash::make($otpRaw),
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        session(['otp_user_id' => $this->user->id]);

        $response = $this->post(route('otp.verify'), [
            'otp_code' => $otpRaw,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertTrue(Auth::check());
        $this->assertEquals($this->user->id, Auth::id());

        // Assert session fields are cleared
        $this->assertNull(session('otp_user_id'));
    }

    public function test_incorrect_otp_fails_and_keeps_user_logged_out()
    {
        $otpRaw = '123456';
        $this->user->update([
            'otp_code' => Hash::make($otpRaw),
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        session(['otp_user_id' => $this->user->id]);

        $response = $this->post(route('otp.verify'), [
            'otp_code' => '654321', // incorrect
        ]);

        $response->assertSessionHasErrors('otp_code');
        $this->assertFalse(Auth::check());
    }

    public function test_resending_otp_updates_code_and_sends_email()
    {
        session(['otp_user_id' => $this->user->id]);

        // Inject last sent time to be more than 60s ago
        Cache::put('last_otp_sent_at_' . $this->user->id, now()->subSeconds(70)->timestamp, 60);

        $response = $this->post(route('otp.resend'));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        Mail::assertSent(OtpMail::class);
    }

    public function test_resending_otp_fails_if_within_cooldown()
    {
        session(['otp_user_id' => $this->user->id]);

        // Inject last sent time to be 10 seconds ago
        Cache::put('last_otp_sent_at_' . $this->user->id, now()->subSeconds(10)->timestamp, 60);

        $response = $this->post(route('otp.resend'));

        $response->assertSessionHasErrors('otp_code');
        Mail::assertNothingSent();
    }

    public function test_login_with_trusted_device_cookie_bypasses_otp()
    {
        // Set trusted device cookie for the test
        $response = $this->withCookie('trusted_device_user_' . $this->user->id, '1')
            ->post('/bkj-portal-access', [
                'email' => 'test@bkjgroup.com',
                'password' => 'password123',
            ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertTrue(Auth::check());
        $this->assertEquals($this->user->id, Auth::id());
        
        // Assert no OTP was sent
        Mail::assertNothingSent();
    }

    public function test_otp_verification_with_remember_me_sets_trusted_device_cookie()
    {
        $otpRaw = '123456';
        $this->user->update([
            'otp_code' => Hash::make($otpRaw),
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        session([
            'otp_user_id' => $this->user->id,
            'remember_me' => true
        ]);

        $response = $this->post(route('otp.verify'), [
            'otp_code' => $otpRaw,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertTrue(Auth::check());
        
        // Assert cookie is queued for 30 days
        $response->assertCookie('trusted_device_user_' . $this->user->id, '1');
    }
}
