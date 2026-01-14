<?php

/**
 * Script to update Google Login credentials
 * Run: php update_google_credentials.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Modules\GlobalSetting\app\Models\Setting;
use Illuminate\Support\Facades\Cache;

echo "Updating Google Login credentials...\n\n";

// Google Credentials
$clientId = 'YOUR_CLIENT_ID_HERE';
$clientSecret = 'YOUR_CLIENT_SECRET_HERE';
$status = 'active';

try {
    // Update Google Client ID
    Setting::updateOrCreate(
        ['key' => 'gmail_client_id'],
        ['value' => $clientId]
    );
    echo "✓ Google Client ID updated successfully\n";

    // Update Google Secret ID
    Setting::updateOrCreate(
        ['key' => 'gmail_secret_id'],
        ['value' => $clientSecret]
    );
    echo "✓ Google Secret ID updated successfully\n";

    // Update Google Login Status
    Setting::updateOrCreate(
        ['key' => 'google_login_status'],
        ['value' => $status]
    );
    echo "✓ Google Login Status set to: {$status}\n";

    // Clear cache
    Cache::forget('setting');
    echo "✓ Cache cleared\n\n";

    echo "✅ All Google Login credentials have been updated successfully!\n";
    echo "\n";
    echo "Google Redirect URI: https://amanlaw.ch/auth/google/callback\n";
    echo "Make sure this URI is added in Google Cloud Console:\n";
    echo "https://console.cloud.google.com/apis/credentials\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
