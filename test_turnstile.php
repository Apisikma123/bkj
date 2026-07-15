<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Http;

$response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
    'secret' => '1x00000000000000000000000000000000AA',
    'response' => 'dummy_response', // Testing keys don't strictly care about the exact string if it's the test secret, or maybe they do?
]);

echo "Status: " . $response->status() . "\n";
echo "Body: " . $response->body() . "\n";
