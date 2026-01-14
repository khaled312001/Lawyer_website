<?php

/**
 * Google OAuth Diagnostic Script
 * This script checks your Google OAuth configuration and helps identify issues
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

echo "\n";
echo "========================================\n";
echo "Google OAuth Configuration Diagnostic\n";
echo "========================================\n\n";

// Get settings from cache or database
Cache::forget('setting');
$settings = Cache::remember('setting', 3600, function () {
    return DB::table('settings')->get()->pluck('value', 'key');
});

// Convert to object for easier access
$setting = (object) [
    'google_login_status' => $settings['google_login_status'] ?? 'inactive',
    'gmail_client_id' => $settings['gmail_client_id'] ?? '',
    'gmail_secret_id' => $settings['gmail_secret_id'] ?? '',
];

echo "1. Checking Google Login Status...\n";
echo "   Status: " . ($setting->google_login_status === 'active' ? "✓ ACTIVE" : "✗ INACTIVE") . "\n\n";

echo "2. Checking Google Client ID...\n";
if (empty($setting->gmail_client_id) || 
    $setting->gmail_client_id === 'google_client_id' || 
    $setting->gmail_client_id === 'gmail_client_id') {
    echo "   ✗ ERROR: Google Client ID is missing or not configured!\n";
    echo "   Current value: '" . ($setting->gmail_client_id ?: 'EMPTY') . "'\n\n";
} else {
    echo "   ✓ Google Client ID is set\n";
    echo "   Client ID: " . substr($setting->gmail_client_id, 0, 20) . "...\n\n";
}

echo "3. Checking Google Client Secret...\n";
if (empty($setting->gmail_secret_id) || 
    $setting->gmail_secret_id === 'google_secret_id' || 
    $setting->gmail_secret_id === 'gmail_secret_id') {
    echo "   ✗ ERROR: Google Client Secret is missing or not configured!\n";
    echo "   Current value: '" . ($setting->gmail_secret_id ?: 'EMPTY') . "'\n\n";
} else {
    echo "   ✓ Google Client Secret is set\n";
    echo "   Secret: " . substr($setting->gmail_secret_id, 0, 10) . "...\n\n";
}

// Get the redirect URI
$appUrl = config('app.url');
$redirectUri = $appUrl . '/auth/google/callback';

echo "4. Redirect URI Configuration...\n";
echo "   Application URL: {$appUrl}\n";
echo "   Redirect URI: {$redirectUri}\n\n";

echo "5. Configuration Check Summary...\n";
$hasErrors = false;

if ($setting->google_login_status !== 'active') {
    echo "   ✗ Google Login is not active\n";
    $hasErrors = true;
}

if (empty($setting->gmail_client_id) || 
    $setting->gmail_client_id === 'google_client_id' || 
    $setting->gmail_client_id === 'gmail_client_id') {
    echo "   ✗ Google Client ID is missing or invalid\n";
    $hasErrors = true;
}

if (empty($setting->gmail_secret_id) || 
    $setting->gmail_secret_id === 'google_secret_id' || 
    $setting->gmail_secret_id === 'gmail_secret_id') {
    echo "   ✗ Google Client Secret is missing or invalid\n";
    $hasErrors = true;
}

if (!$hasErrors) {
    echo "   ✓ All basic configuration checks passed\n";
}

echo "\n";
echo "========================================\n";
echo "How to Fix the 'OAuth client not found' Error\n";
echo "========================================\n\n";

echo "The error 'Error 401: invalid_client' typically means:\n";
echo "1. The Client ID doesn't exist in Google Cloud Console\n";
echo "2. The Client ID was deleted or disabled\n";
echo "3. The redirect URI is not configured in Google Cloud Console\n\n";

echo "Steps to Fix:\n";
echo "-------------\n\n";

echo "Step 1: Verify/Update Google Credentials in Database\n";
echo "   Option A - Using Admin Panel:\n";
echo "   1. Login to admin panel\n";
echo "   2. Go to: Settings > Credentials > Social Login\n";
echo "   3. Enter valid Google Client ID and Secret\n";
echo "   4. Set Google Login Status to 'Active'\n";
echo "   5. Click Update\n\n";

echo "   Option B - Using Artisan Command:\n";
echo "   php artisan google:update-credentials --client_id=\"YOUR_CLIENT_ID\" --client_secret=\"YOUR_CLIENT_SECRET\" --status=active\n\n";

echo "   Option C - Using SQL:\n";
echo "   UPDATE `settings` SET `value` = 'YOUR_CLIENT_ID' WHERE `key` = 'gmail_client_id';\n";
echo "   UPDATE `settings` SET `value` = 'YOUR_CLIENT_SECRET' WHERE `key` = 'gmail_secret_id';\n";
echo "   UPDATE `settings` SET `value` = 'active' WHERE `key` = 'google_login_status';\n\n";

echo "Step 2: Configure Redirect URI in Google Cloud Console\n";
echo "   1. Go to: https://console.cloud.google.com/apis/credentials\n";
echo "   2. Select your OAuth 2.0 Client ID\n";
echo "   3. In 'Authorized redirect URIs', add:\n";
echo "      {$redirectUri}\n";
echo "   4. Also add (if using different environments):\n";
echo "      http://127.0.0.1:8000/auth/google/callback (for local)\n";
echo "      https://amanlaw.ch/auth/google/callback (if different domain)\n";
echo "   5. Click 'Save'\n\n";

echo "Step 3: Verify Client ID Exists\n";
echo "   - Make sure the Client ID you're using actually exists in Google Cloud Console\n";
echo "   - Check that it's not deleted or disabled\n";
echo "   - Verify it's an 'OAuth 2.0 Client ID' (not API Key or Service Account)\n\n";

echo "Step 4: Clear Cache\n";
echo "   php artisan cache:clear\n";
echo "   php artisan config:clear\n\n";

echo "Step 5: Test Again\n";
echo "   Try signing in with Google again\n\n";

echo "========================================\n";
echo "Current Configuration Values:\n";
echo "========================================\n";
echo "Google Login Status: " . ($setting->google_login_status ?? 'NOT SET') . "\n";
echo "Google Client ID: " . ($setting->gmail_client_id ?: 'NOT SET') . "\n";
echo "Google Client Secret: " . ($setting->gmail_secret_id ? 'SET (hidden)' : 'NOT SET') . "\n";
echo "Redirect URI: {$redirectUri}\n";
echo "\n";
