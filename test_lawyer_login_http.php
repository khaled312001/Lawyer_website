<?php

/**
 * HTTP Test script for lawyer login
 * Tests the login endpoint directly
 * 
 * Usage: php test_lawyer_login_http.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Http;

echo "=== HTTP Lawyer Login Test ===\n\n";

$baseUrl = 'https://lawyer.khaledahmed.net';
$email = 'james.anderson@law.com';
$password = '1234';

echo "Testing login endpoint:\n";
echo "URL: {$baseUrl}/lawyer/lawyer-login\n";
echo "Email: {$email}\n";
echo "Password: {$password}\n\n";

// First, get the login page to get CSRF token and session
echo "Step 1: Getting login page...\n";
try {
    $loginPageResponse = Http::get("{$baseUrl}/login?type=lawyer");
    
    if ($loginPageResponse->successful()) {
        echo "✓ Login page loaded successfully\n";
        $html = $loginPageResponse->body();
        
        // Try to extract CSRF token
        if (preg_match('/name="_token" value="([^"]+)"/', $html, $matches)) {
            $csrfToken = $matches[1];
            echo "✓ CSRF token found\n";
        } else {
            echo "⚠ Could not extract CSRF token from HTML\n";
            $csrfToken = null;
        }
    } else {
        echo "❌ Failed to load login page: " . $loginPageResponse->status() . "\n";
        exit(1);
    }
} catch (\Exception $e) {
    echo "❌ Error loading login page: " . $e->getMessage() . "\n";
    exit(1);
}

// Step 2: Attempt login
echo "\nStep 2: Attempting login...\n";

try {
    $loginData = [
        'email' => $email,
        'password' => $password,
        'lawyer_remember' => false,
    ];
    
    if ($csrfToken) {
        $loginData['_token'] = $csrfToken;
    }
    
    // Create a session cookie jar
    $cookies = $loginPageResponse->cookies();
    
    $loginResponse = Http::withCookies($cookies, parse_url($baseUrl, PHP_URL_HOST))
        ->asForm()
        ->post("{$baseUrl}/lawyer/lawyer-login", $loginData);
    
    echo "Response Status: " . $loginResponse->status() . "\n";
    
    if ($loginResponse->redirect()) {
        $redirectUrl = $loginResponse->header('Location');
        echo "✓ Redirect detected\n";
        echo "Redirect URL: {$redirectUrl}\n";
        
        if (strpos($redirectUrl, '/lawyer/dashboard') !== false) {
            echo "✅ SUCCESS! Redirected to lawyer dashboard!\n";
            echo "Login is working correctly.\n";
        } else if (strpos($redirectUrl, '/login') !== false) {
            echo "❌ FAILED! Redirected back to login page.\n";
            echo "This means login failed. Possible reasons:\n";
            echo "  - Invalid credentials\n";
            echo "  - Account not active\n";
            echo "  - Email not verified\n";
            echo "  - reCAPTCHA required\n";
        } else {
            echo "⚠ Redirected to: {$redirectUrl}\n";
        }
    } else {
        echo "Response Body (first 500 chars):\n";
        echo substr($loginResponse->body(), 0, 500) . "\n";
    }
    
} catch (\Exception $e) {
    echo "❌ Error during login: " . $e->getMessage() . "\n";
    echo "This might be due to:\n";
    echo "  - Network issues\n";
    echo "  - Server configuration\n";
    echo "  - CSRF token issues\n";
}

echo "\n=== Test Complete ===\n";
echo "\nNote: If HTTP test doesn't work, you can test manually:\n";
echo "1. Open: {$baseUrl}/login?type=lawyer\n";
echo "2. Enter email: {$email}\n";
echo "3. Enter password: {$password}\n";
echo "4. Click تسجيل الدخول\n";

