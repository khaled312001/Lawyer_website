<?php

/**
 * Test script to check all lawyers in database
 * 
 * Usage: php test_all_lawyers.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Enums\LawyerStatus;
use Illuminate\Support\Facades\Hash;

echo "=== All Lawyers in Database ===\n\n";

$lawyers = Lawyer::all();

if ($lawyers->isEmpty()) {
    echo "❌ No lawyers found in database.\n";
    echo "Please run: php artisan db:seed\n";
    exit(1);
}

echo "Found {$lawyers->count()} lawyer(s):\n\n";

foreach ($lawyers as $lawyer) {
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "ID: {$lawyer->id}\n";
    echo "Name: {$lawyer->name}\n";
    echo "Email: {$lawyer->email}\n";
    echo "Status: {$lawyer->status} " . ($lawyer->status == LawyerStatus::ACTIVE->value ? "(ACTIVE)" : "(INACTIVE)") . "\n";
    echo "Email Verified: " . ($lawyer->email_verified_at ? $lawyer->email_verified_at : "NOT VERIFIED") . "\n";
    
    // Test password
    $lawyerPassword = $lawyer->getRawOriginal('password');
    $passwordValid = Hash::check('1234', $lawyerPassword);
    echo "Password (1234): " . ($passwordValid ? "✓ Valid" : "✗ Invalid") . "\n";
    
    // Can login?
    $canLogin = ($lawyer->status == LawyerStatus::ACTIVE->value && 
                $lawyer->email_verified_at != null && 
                $passwordValid);
    echo "Can Login: " . ($canLogin ? "✅ YES" : "❌ NO") . "\n";
    echo "\n";
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "\n=== Summary ===\n";
$activeLawyers = $lawyers->filter(function($lawyer) {
    return $lawyer->status == LawyerStatus::ACTIVE->value;
});
$verifiedLawyers = $lawyers->filter(function($lawyer) {
    return $lawyer->email_verified_at != null;
});
$loginableLawyers = $lawyers->filter(function($lawyer) {
    $password = $lawyer->getRawOriginal('password');
    return $lawyer->status == LawyerStatus::ACTIVE->value && 
           $lawyer->email_verified_at != null && 
           Hash::check('1234', $password);
});

echo "Total Lawyers: {$lawyers->count()}\n";
echo "Active: {$activeLawyers->count()}\n";
echo "Verified: {$verifiedLawyers->count()}\n";
echo "Can Login (with password 1234): {$loginableLawyers->count()}\n\n";

if ($loginableLawyers->count() > 0) {
    echo "✅ Lawyers that can login:\n";
    foreach ($loginableLawyers as $lawyer) {
        echo "  - {$lawyer->email} ({$lawyer->name})\n";
    }
} else {
    echo "❌ No lawyers can login with password '1234'\n";
}

