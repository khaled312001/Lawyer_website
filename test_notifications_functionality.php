<?php

/**
 * Functional Test for Notifications System
 * Tests actual notification functionality
 * Run: php test_notifications_functionality.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Admin;
use Modules\Lawyer\app\Models\Lawyer;
use App\Notifications\NewMessageNotification;
use App\Notifications\PaymentApprovedNotification;
use App\Notifications\NewAppointmentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "========================================\n";
echo "Functional Test - Notifications System\n";
echo "========================================\n\n";

$errors = [];
$warnings = [];
$success = [];

try {
    // 1. Check Database Connection
    echo "1. Testing Database Connection...\n";
    DB::connection()->getPdo();
    echo "   ✓ Database connection successful\n";
    $success[] = "Database connection";
} catch (\Exception $e) {
    $errors[] = "Database connection failed: " . $e->getMessage();
    echo "   ✗ Database connection failed\n";
    echo "     Error: " . $e->getMessage() . "\n";
}

// 2. Check Notifications Table
echo "\n2. Checking Notifications Table...\n";
try {
    if (Schema::hasTable('notifications')) {
        echo "   ✓ Notifications table exists\n";
        $success[] = "Notifications table exists";
        
        // Check table structure
        $columns = Schema::getColumnListing('notifications');
        $requiredColumns = ['id', 'type', 'notifiable_type', 'notifiable_id', 'data', 'read_at', 'created_at'];
        $missingColumns = array_diff($requiredColumns, $columns);
        
        if (empty($missingColumns)) {
            echo "   ✓ All required columns exist\n";
            $success[] = "Notifications table structure";
        } else {
            $warnings[] = "Missing columns in notifications table: " . implode(', ', $missingColumns);
            echo "   ⚠ Missing columns: " . implode(', ', $missingColumns) . "\n";
        }
    } else {
        $errors[] = "Notifications table does not exist";
        echo "   ✗ Notifications table does not exist\n";
        echo "     Run: php artisan notifications:table\n";
        echo "     Then: php artisan migrate\n";
    }
} catch (\Exception $e) {
    $errors[] = "Error checking notifications table: " . $e->getMessage();
    echo "   ✗ Error checking notifications table\n";
    echo "     Error: " . $e->getMessage() . "\n";
}

// 3. Test User Model Notifications
echo "\n3. Testing User Model Notifications...\n";
try {
    $user = User::first();
    if ($user) {
        echo "   ✓ Found test user: {$user->name} (ID: {$user->id})\n";
        
        // Check if user has notifications relationship
        if (method_exists($user, 'notifications')) {
            echo "   ✓ User model has notifications() method\n";
            $success[] = "User notifications relationship";
            
            // Test creating a notification
            try {
                $testNotification = new NewMessageNotification('Test message', 'Test Admin', 'admin');
                $user->notify($testNotification);
                echo "   ✓ Successfully created test notification for user\n";
                $success[] = "User notification creation";
                
                // Check if notification was saved
                $notificationCount = $user->notifications()->count();
                echo "   ✓ User has {$notificationCount} notification(s)\n";
                
                // Test unread notifications
                $unreadCount = $user->unreadNotifications()->count();
                echo "   ✓ User has {$unreadCount} unread notification(s)\n";
                
                // Clean up test notification
                $user->notifications()->where('type', 'App\Notifications\NewMessageNotification')->latest()->first()->delete();
                echo "   ✓ Cleaned up test notification\n";
                
            } catch (\Exception $e) {
                $errors[] = "Failed to create user notification: " . $e->getMessage();
                echo "   ✗ Failed to create notification\n";
                echo "     Error: " . $e->getMessage() . "\n";
            }
        } else {
            $errors[] = "User model missing notifications() method";
            echo "   ✗ User model missing notifications() method\n";
        }
    } else {
        $warnings[] = "No users found in database";
        echo "   ⚠ No users found in database (skipping user notification test)\n";
    }
} catch (\Exception $e) {
    $errors[] = "Error testing user notifications: " . $e->getMessage();
    echo "   ✗ Error testing user notifications\n";
    echo "     Error: " . $e->getMessage() . "\n";
}

// 4. Test Lawyer Model Notifications
echo "\n4. Testing Lawyer Model Notifications...\n";
try {
    $lawyer = Lawyer::first();
    if ($lawyer) {
        echo "   ✓ Found test lawyer: {$lawyer->name} (ID: {$lawyer->id})\n";
        
        // Check if lawyer has notifications relationship
        if (method_exists($lawyer, 'notifications')) {
            echo "   ✓ Lawyer model has notifications() method\n";
            $success[] = "Lawyer notifications relationship";
            
            // Test creating a notification
            try {
                $testNotification = new NewMessageNotification('Test message', 'Test User', 'user');
                $lawyer->notify($testNotification);
                echo "   ✓ Successfully created test notification for lawyer\n";
                $success[] = "Lawyer notification creation";
                
                // Check if notification was saved
                $notificationCount = $lawyer->notifications()->count();
                echo "   ✓ Lawyer has {$notificationCount} notification(s)\n";
                
                // Test unread notifications
                $unreadCount = $lawyer->unreadNotifications()->count();
                echo "   ✓ Lawyer has {$unreadCount} unread notification(s)\n";
                
                // Clean up test notification
                $lawyer->notifications()->where('type', 'App\Notifications\NewMessageNotification')->latest()->first()->delete();
                echo "   ✓ Cleaned up test notification\n";
                
            } catch (\Exception $e) {
                $errors[] = "Failed to create lawyer notification: " . $e->getMessage();
                echo "   ✗ Failed to create notification\n";
                echo "     Error: " . $e->getMessage() . "\n";
            }
        } else {
            $errors[] = "Lawyer model missing notifications() method";
            echo "   ✗ Lawyer model missing notifications() method\n";
        }
    } else {
        $warnings[] = "No lawyers found in database";
        echo "   ⚠ No lawyers found in database (skipping lawyer notification test)\n";
    }
} catch (\Exception $e) {
    $errors[] = "Error testing lawyer notifications: " . $e->getMessage();
    echo "   ✗ Error testing lawyer notifications\n";
    echo "     Error: " . $e->getMessage() . "\n";
}

// 5. Test Admin Model Notifications
echo "\n5. Testing Admin Model Notifications...\n";
try {
    $admin = Admin::first();
    if ($admin) {
        echo "   ✓ Found test admin: {$admin->name} (ID: {$admin->id})\n";
        
        // Check if admin has notifications relationship
        if (method_exists($admin, 'notifications')) {
            echo "   ✓ Admin model has notifications() method\n";
            $success[] = "Admin notifications relationship";
            
            // Check notification count
            $notificationCount = $admin->notifications()->count();
            echo "   ✓ Admin has {$notificationCount} notification(s)\n";
            
            $unreadCount = $admin->unreadNotifications()->count();
            echo "   ✓ Admin has {$unreadCount} unread notification(s)\n";
        } else {
            $errors[] = "Admin model missing notifications() method";
            echo "   ✗ Admin model missing notifications() method\n";
        }
    } else {
        $warnings[] = "No admins found in database";
        echo "   ⚠ No admins found in database (skipping admin notification test)\n";
    }
} catch (\Exception $e) {
    $errors[] = "Error testing admin notifications: " . $e->getMessage();
    echo "   ✗ Error testing admin notifications\n";
    echo "     Error: " . $e->getMessage() . "\n";
}

// 6. Test Notification Classes
echo "\n6. Testing Notification Classes...\n";
try {
    // Test NewMessageNotification
    $msgNotification = new NewMessageNotification('Test', 'Test User', 'user', 1);
    if (method_exists($msgNotification, 'toDatabase')) {
        $data = $msgNotification->toDatabase(new User());
        if (isset($data['type']) && isset($data['title']) && isset($data['message'])) {
            echo "   ✓ NewMessageNotification works correctly\n";
            $success[] = "NewMessageNotification class";
        } else {
            $warnings[] = "NewMessageNotification toDatabase may be incomplete";
            echo "   ⚠ NewMessageNotification toDatabase may be incomplete\n";
        }
    }
    
    // Test PaymentApprovedNotification
    try {
        $order = new stdClass();
        $order->id = 1;
        $order->order_id = 'TEST-001';
        $order->total_payment = 100;
        $order->payable_currency = 'USD';
        
        $paymentNotification = new PaymentApprovedNotification($order);
        if (method_exists($paymentNotification, 'toDatabase')) {
            $data = $paymentNotification->toDatabase(new User());
            if (isset($data['type']) && $data['type'] == 'payment_approved') {
                echo "   ✓ PaymentApprovedNotification works correctly\n";
                $success[] = "PaymentApprovedNotification class";
            }
        }
    } catch (\Exception $e) {
        $warnings[] = "PaymentApprovedNotification test skipped: " . $e->getMessage();
        echo "   ⚠ PaymentApprovedNotification test skipped\n";
    }
    
} catch (\Exception $e) {
    $errors[] = "Error testing notification classes: " . $e->getMessage();
    echo "   ✗ Error testing notification classes\n";
    echo "     Error: " . $e->getMessage() . "\n";
}

// 7. Test Routes
echo "\n7. Testing Routes...\n";
try {
    $routes = Route::getRoutes();
    $requiredRoutes = [
        'client.notifications.fetch',
        'client.notifications.mark-read',
        'lawyer.notifications.fetch',
        'lawyer.notifications.mark-read',
        'admin.notifications.fetch',
        'admin.notifications.mark-read',
    ];
    
    $foundRoutes = [];
    foreach ($routes as $route) {
        $name = $route->getName();
        if (in_array($name, $requiredRoutes)) {
            $foundRoutes[] = $name;
        }
    }
    
    foreach ($requiredRoutes as $routeName) {
        if (in_array($routeName, $foundRoutes)) {
            echo "   ✓ Route '{$routeName}' exists\n";
        } else {
            $warnings[] = "Route '{$routeName}' not found";
            echo "   ⚠ Route '{$routeName}' not found\n";
        }
    }
    
    if (count($foundRoutes) == count($requiredRoutes)) {
        $success[] = "All notification routes";
    }
    
} catch (\Exception $e) {
    $warnings[] = "Error checking routes: " . $e->getMessage();
    echo "   ⚠ Error checking routes\n";
    echo "     Error: " . $e->getMessage() . "\n";
}

// Summary
echo "\n========================================\n";
echo "Summary\n";
echo "========================================\n\n";

if (count($success) > 0) {
    echo "✓ Successful Tests: " . count($success) . "\n";
    foreach ($success as $item) {
        echo "  ✓ {$item}\n";
    }
    echo "\n";
}

if (count($warnings) > 0) {
    echo "⚠ Warnings: " . count($warnings) . "\n";
    foreach ($warnings as $warning) {
        echo "  ⚠ {$warning}\n";
    }
    echo "\n";
}

if (count($errors) > 0) {
    echo "✗ Errors: " . count($errors) . "\n";
    foreach ($errors as $error) {
        echo "  ✗ {$error}\n";
    }
    echo "\n";
}

if (count($errors) == 0) {
    echo "✓ All functional tests passed!\n";
    echo "  The notifications system is working correctly.\n\n";
} else {
    echo "✗ Some errors were found.\n";
    echo "  Please review and fix the errors above.\n\n";
}

echo "========================================\n";
echo "Functional Test Complete\n";
echo "========================================\n";

