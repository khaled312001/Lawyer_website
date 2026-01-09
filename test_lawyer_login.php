<?php

/**
 * Simple script to test lawyer login functionality
 * 
 * Usage: php test_lawyer_login.php
 * 
 * This script tests the login for:
 * - Email: daniel.martinez@law.com
 * - Password: 1234
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Enums\LawyerStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

echo "=== Lawyer Login Test ===\n\n";

// Test credentials
$email = 'daniel.martinez@law.com';
$password = '1234';

echo "Testing login for:\n";
echo "Email: {$email}\n";
echo "Password: {$password}\n\n";

// Check if lawyer exists
$lawyer = Lawyer::where('email', $email)->first();

if (!$lawyer) {
    echo "❌ ERROR: Lawyer with email '{$email}' not found in database.\n";
    echo "\nTo create the lawyer, run one of:\n";
    echo "  - php artisan db:seed (seeds all data)\n";
    echo "  - php artisan db:seed --class=Modules\\Lawyer\\database\\seeders\\LawyerDatabaseSeeder (seeds only lawyers)\n";
    echo "\nOr test with an existing lawyer from LOGIN_CREDENTIALS.md\n";
    exit(1);
}

echo "✓ Lawyer found: {$lawyer->name}\n";

// Check status
if ($lawyer->status != LawyerStatus::ACTIVE->value) {
    echo "⚠ WARNING: Lawyer status is: {$lawyer->status}\n";
    echo "Expected: " . LawyerStatus::ACTIVE->value . "\n";
    echo "The lawyer account is not active. Login will fail.\n";
} else {
    echo "✓ Lawyer status: ACTIVE\n";
}

// Check email verification
if ($lawyer->email_verified_at == null) {
    echo "⚠ WARNING: Email is not verified.\n";
    echo "The lawyer email is not verified. Login will fail.\n";
} else {
    echo "✓ Email verified at: {$lawyer->email_verified_at}\n";
}

// Test password
$lawyerPassword = $lawyer->getRawOriginal('password');
$passwordValid = Hash::check($password, $lawyerPassword);

if ($passwordValid) {
    echo "✓ Password is correct\n";
} else {
    echo "❌ ERROR: Password is incorrect\n";
    echo "The password '{$password}' does not match the stored hash.\n";
    exit(1);
}

// Summary
echo "\n=== Test Summary ===\n";
echo "Lawyer exists: ✓\n";
echo "Status: " . ($lawyer->status == LawyerStatus::ACTIVE->value ? "✓ ACTIVE" : "✗ {$lawyer->status}") . "\n";
echo "Email verified: " . ($lawyer->email_verified_at != null ? "✓" : "✗ NOT VERIFIED") . "\n";
echo "Password valid: " . ($passwordValid ? "✓" : "✗") . "\n\n";

if ($lawyer->status == LawyerStatus::ACTIVE->value && 
    $lawyer->email_verified_at != null && 
    $passwordValid) {
    echo "✅ All checks passed! Login should work.\n";
    echo "\nTo test login in browser:\n";
    echo "1. Go to: https://lawyer.khaledahmed.net/login?type=lawyer\n";
    echo "2. Enter email: {$email}\n";
    echo "3. Enter password: {$password}\n";
    echo "4. Click Login\n";
} else {
    echo "❌ Some checks failed. Login may not work.\n";
    echo "\nTo fix:\n";
    if ($lawyer->status != LawyerStatus::ACTIVE->value) {
        echo "- Update lawyer status to ACTIVE\n";
    }
    if ($lawyer->email_verified_at == null) {
        echo "- Verify lawyer email\n";
    }
    exit(1);
}

