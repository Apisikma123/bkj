<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Turnstile implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Bypass if running tests, if secret key is not set, or using dummy testing key
        if (app()->environment('testing') || empty(env('TURNSTILE_SECRET_KEY')) || env('TURNSTILE_SECRET_KEY') === '1x00000000000000000000000000000000AA') {
            return;
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => env('TURNSTILE_SECRET_KEY'),
            'response' => $value,
            'remoteip' => request()->ip(),
        ]);

        if (!$response->successful() || !$response->json('success')) {
            $fail('Verifikasi keamanan (Captcha) gagal. Silakan coba lagi.');
        }
    }
}
