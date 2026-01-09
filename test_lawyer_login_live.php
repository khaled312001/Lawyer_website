<?php

/**
 * Test script for lawyer login on live database
 * Tests james.anderson@law.com login
 * 
 * Usage: php test_lawyer_login_live.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Enums\LawyerStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

echo "=== Lawyer Login Test - Live Database ===\n\n";

// Test credentials
$email = 'james.anderson@law.com';
$password = '1234';

echo "Testing login for:\n";
echo "Email: {$email}\n";
echo "Password: {$password}\n";
echo "URL: https://lawyer.khaledahmed.net/login?type=lawyer\n\n";

// Check if lawyer exists
$lawyer = Lawyer::where('email', $email)->first();

if (!$lawyer) {
    echo "❌ ERROR: Lawyer with email '{$email}' not found in database.\n\n";
    
    // Show all available lawyers
    echo "=== Available Lawyers in Database ===\n";
    $allLawyers = Lawyer::select('id', 'name', 'email', 'status', 'email_verified_at')
        ->orderBy('name')
        ->get();
    
    if ($allLawyers->isEmpty()) {
        echo "No lawyers found in database.\n";
    } else {
        echo "Found {$allLawyers->count()} lawyer(s):\n\n";
        foreach ($allLawyers as $l) {
            $statusText = $l->status == LawyerStatus::ACTIVE->value ? 'ACTIVE' : 'INACTIVE';
            $verifiedText = $l->email_verified_at ? 'VERIFIED' : 'NOT VERIFIED';
            $canLogin = ($l->status == LawyerStatus::ACTIVE->value && $l->email_verified_at != null);
            
            echo "  - {$l->name} ({$l->email})\n";
            echo "    Status: {$statusText} | Verified: {$verifiedText}\n";
            echo "    Can Login: " . ($canLogin ? "✅ YES" : "❌ NO") . "\n\n";
        }
    }
    
    exit(1);
}

echo "✓ Lawyer found: {$lawyer->name}\n";
echo "  ID: {$lawyer->id}\n";
echo "  Status: {$lawyer->status}\n";
echo "  Email Verified: " . ($lawyer->email_verified_at ? $lawyer->email_verified_at : 'NOT VERIFIED') . "\n\n";

// Check status
$statusCheck = $lawyer->status == LawyerStatus::ACTIVE->value;
if ($statusCheck) {
    echo "✓ Lawyer status: ACTIVE\n";
} else {
    echo "❌ ERROR: Lawyer status is: {$lawyer->status}\n";
    echo "Expected: " . LawyerStatus::ACTIVE->value . "\n";
    echo "The lawyer account is not active. Login will fail.\n\n";
}

// Check email verification
$emailVerified = $lawyer->email_verified_at != null;
if ($emailVerified) {
    echo "✓ Email verified at: {$lawyer->email_verified_at}\n";
} else {
    echo "❌ ERROR: Email is not verified.\n";
    echo "The lawyer email is not verified. Login will fail.\n\n";
}

// Test password
$lawyerPassword = $lawyer->getRawOriginal('password');
$passwordValid = Hash::check($password, $lawyerPassword);

if ($passwordValid) {
    echo "✓ Password is correct\n";
} else {
    echo "❌ ERROR: Password is incorrect\n";
    echo "The password '{$password}' does not match the stored hash.\n";
    echo "Stored hash: " . substr($lawyerPassword, 0, 20) . "...\n\n";
    
    // Try to test with common passwords
    echo "Testing common passwords...\n";
    $commonPasswords = ['1234', 'password', '123456', 'admin'];
    foreach ($commonPasswords as $pwd) {
        if (Hash::check($pwd, $lawyerPassword)) {
            echo "  ✓ Password might be: '{$pwd}'\n";
        }
    }
    echo "\n";
}

// Summary
echo "\n=== Test Summary ===\n";
echo "Lawyer exists: ✓\n";
echo "Status: " . ($statusCheck ? "✓ ACTIVE" : "✗ {$lawyer->status}") . "\n";
echo "Email verified: " . ($emailVerified ? "✓" : "✗ NOT VERIFIED") . "\n";
echo "Password valid: " . ($passwordValid ? "✓" : "✗") . "\n\n";

// Try to authenticate programmatically
echo "=== Attempting Login ===\n";
try {
    // Clear any existing authentication
    Auth::guard('lawyer')->logout();
    
    // Check if we can authenticate
    if ($statusCheck && $emailVerified && $passwordValid) {
        // Try to login using the controller method logic
        $lawyerPassword = $lawyer->getRawOriginal('password');
        
        if (Hash::check($password, $lawyerPassword)) {
            // Login the lawyer directly
            Auth::guard('lawyer')->login($lawyer, false);
            
            if (Auth::guard('lawyer')->check()) {
                echo "✓ Login successful!\n";
                echo "✓ Authenticated as: " . Auth::guard('lawyer')->user()->name . "\n";
                echo "✓ User ID: " . Auth::guard('lawyer')->id() . "\n";
                Auth::guard('lawyer')->logout();
            } else {
                echo "⚠ Login attempt failed (guard check failed)\n";
            }
        } else {
            echo "⚠ Password check failed\n";
        }
    } else {
        echo "⚠ Cannot attempt login - some checks failed above\n";
    }
} catch (\Exception $e) {
    echo "⚠ Could not test login programmatically: " . $e->getMessage() . "\n";
    echo "But credentials check passed, so manual login should work.\n";
}

// Final verdict
echo "\n=== Final Verdict ===\n";
if ($statusCheck && $emailVerified && $passwordValid) {
    echo "✅ All checks passed! Login should work.\n";
    echo "\nTo test login in browser:\n";
    echo "1. Go to: https://lawyer.khaledahmed.net/login?type=lawyer\n";
    echo "2. Enter email: {$email}\n";
    echo "3. Enter password: {$password}\n";
    echo "4. Click تسجيل الدخول (Login)\n";
    echo "5. Should redirect to: /lawyer/dashboard\n";
} else {
    echo "❌ Some checks failed. Login may not work.\n";
    echo "\nTo fix:\n";
    if (!$statusCheck) {
        echo "- Update lawyer status to ACTIVE (status = 1)\n";
        echo "  SQL: UPDATE lawyers SET status = 1 WHERE email = '{$email}';\n";
        echo "  Or use admin panel: https://lawyer.khaledahmed.net/admin/lawyer\n";
    }
    if (!$emailVerified) {
        echo "- Verify lawyer email\n";
        echo "  SQL: UPDATE lawyers SET email_verified_at = NOW() WHERE email = '{$email}';\n";
        echo "  Or use admin panel to send verification email\n";
    }
    if (!$passwordValid) {
        echo "- Reset password from admin panel\n";
        echo "  Go to: https://lawyer.khaledahmed.net/admin/lawyer\n";
        echo "  Click on lawyer and update credentials\n";
    }
    exit(1);
}

echo "\n=== Test Complete ===\n";

