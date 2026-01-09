<?php

/**
 * Script to test and fix notifications system
 * Run: php test_notifications_system.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

echo "========================================\n";
echo "Testing Notifications System\n";
echo "========================================\n\n";

$errors = [];
$warnings = [];
$fixed = [];

// 1. Check Controllers
echo "1. Checking Controllers...\n";
$controllers = [
    'Client' => 'app/Http/Controllers/Client/NotificationController.php',
    'Lawyer' => 'app/Http/Controllers/Lawyer/NotificationController.php',
    'Admin' => 'app/Http/Controllers/Admin/NotificationController.php',
];

foreach ($controllers as $type => $path) {
    if (File::exists($path)) {
        echo "   ✓ {$type} NotificationController exists\n";
        
        // Check if it has required methods
        $content = File::get($path);
        $requiredMethods = ['index', 'fetch', 'markAsRead', 'markAllAsRead'];
        foreach ($requiredMethods as $method) {
            if (strpos($content, "function {$method}") !== false) {
                echo "     ✓ Method {$method} exists\n";
            } else {
                $warnings[] = "{$type} NotificationController missing method: {$method}";
                echo "     ✗ Method {$method} missing\n";
            }
        }
    } else {
        $errors[] = "{$type} NotificationController not found: {$path}";
        echo "   ✗ {$type} NotificationController not found\n";
    }
}

echo "\n";

// 2. Check Notifications Classes
echo "2. Checking Notification Classes...\n";
$notifications = [
    'NewMessageNotification' => 'app/Notifications/NewMessageNotification.php',
    'PaymentApprovedNotification' => 'app/Notifications/PaymentApprovedNotification.php',
    'NewAppointmentNotification' => 'app/Notifications/NewAppointmentNotification.php',
    'NewContactMessageNotification' => 'app/Notifications/NewContactMessageNotification.php',
    'NewOrderNotification' => 'app/Notifications/NewOrderNotification.php',
    'NewAppointmentRequestNotification' => 'app/Notifications/NewAppointmentRequestNotification.php',
    'NewPartnershipRequestNotification' => 'app/Notifications/NewPartnershipRequestNotification.php',
    'NewLegalAidCheckNotification' => 'app/Notifications/NewLegalAidCheckNotification.php',
];

foreach ($notifications as $name => $path) {
    if (File::exists($path)) {
        echo "   ✓ {$name} exists\n";
        
        // Check if it extends Notification
        $content = File::get($path);
        if (strpos($content, 'extends Notification') !== false) {
            echo "     ✓ Extends Notification class\n";
        } else {
            $warnings[] = "{$name} may not extend Notification properly";
            echo "     ⚠ May not extend Notification properly\n";
        }
        
        // Check if it has toDatabase method
        if (strpos($content, 'toDatabase') !== false) {
            echo "     ✓ Has toDatabase method\n";
        } else {
            $warnings[] = "{$name} missing toDatabase method";
            echo "     ✗ Missing toDatabase method\n";
        }
    } else {
        $errors[] = "Notification class not found: {$path}";
        echo "   ✗ {$name} not found\n";
    }
}

echo "\n";

// 3. Check Routes
echo "3. Checking Routes...\n";
$routeFiles = [
    'client' => 'routes/client.php',
    'lawyer' => 'routes/lawyer.php',
    'admin' => 'routes/admin.php',
];

foreach ($routeFiles as $type => $file) {
    if (File::exists($file)) {
        $content = File::get($file);
        
        // Check for notification routes
        if (strpos($content, 'notifications') !== false || strpos($content, 'NotificationController') !== false) {
            echo "   ✓ {$type} routes file has notification routes\n";
        } else {
            $warnings[] = "{$type} routes file may be missing notification routes";
            echo "   ⚠ {$type} routes file may be missing notification routes\n";
        }
    } else {
        $errors[] = "Routes file not found: {$file}";
        echo "   ✗ {$type} routes file not found\n";
    }
}

echo "\n";

// 4. Check Views
echo "4. Checking Views...\n";
$views = [
    'Client' => 'resources/views/client/notifications/index.blade.php',
    'Lawyer' => 'resources/views/lawyer/notifications/index.blade.php',
    'Admin' => 'resources/views/admin/notifications/index.blade.php',
];

foreach ($views as $type => $path) {
    if (File::exists($path)) {
        echo "   ✓ {$type} notifications view exists\n";
    } else {
        $warnings[] = "{$type} notifications view not found: {$path}";
        echo "   ⚠ {$type} notifications view not found\n";
    }
}

echo "\n";

// 5. Check Models
echo "5. Checking Models...\n";

// Check User model
$userModel = 'app/Models/User.php';
if (File::exists($userModel)) {
    $content = File::get($userModel);
    if (strpos($content, 'Notifiable') !== false) {
        echo "   ✓ User model has Notifiable trait\n";
    } else {
        $errors[] = "User model missing Notifiable trait";
        echo "   ✗ User model missing Notifiable trait\n";
        
        // Try to fix
        if (strpos($content, 'use HasApiTokens, HasFactory') !== false) {
            $content = str_replace(
                'use HasApiTokens, HasFactory, Notifiable;',
                'use HasApiTokens, HasFactory, Notifiable;',
                $content
            );
            if (strpos($content, 'use Illuminate\\Notifications\\Notifiable;') === false) {
                // Add use statement
                $content = str_replace(
                    'use Illuminate\\Foundation\\Auth\\User as Authenticatable;',
                    "use Illuminate\\Foundation\\Auth\\User as Authenticatable;\nuse Illuminate\\Notifications\\Notifiable;",
                    $content
                );
            }
            if (strpos($content, 'use HasApiTokens, HasFactory, Notifiable') === false && strpos($content, 'use HasApiTokens, HasFactory') !== false) {
                $content = str_replace(
                    'use HasApiTokens, HasFactory',
                    'use HasApiTokens, HasFactory, Notifiable',
                    $content
                );
            }
            File::put($userModel, $content);
            $fixed[] = "Added Notifiable trait to User model";
            echo "     ✓ Fixed: Added Notifiable trait\n";
        }
    }
} else {
    $errors[] = "User model not found";
    echo "   ✗ User model not found\n";
}

// Check Lawyer model
$lawyerModel = 'Modules/Lawyer/app/Models/Lawyer.php';
if (File::exists($lawyerModel)) {
    $content = File::get($lawyerModel);
    if (strpos($content, 'Notifiable') !== false) {
        echo "   ✓ Lawyer model has Notifiable trait\n";
    } else {
        $errors[] = "Lawyer model missing Notifiable trait";
        echo "   ✗ Lawyer model missing Notifiable trait\n";
        
        // Try to fix
        if (strpos($content, 'use HasApiTokens, HasFactory') !== false) {
            if (strpos($content, 'use Illuminate\\Notifications\\Notifiable;') === false) {
                // Add use statement
                $content = str_replace(
                    'use Illuminate\\Foundation\\Auth\\User as Authenticatable;',
                    "use Illuminate\\Foundation\\Auth\\User as Authenticatable;\nuse Illuminate\\Notifications\\Notifiable;",
                    $content
                );
            }
            $content = str_replace(
                'use HasApiTokens, HasFactory;',
                'use HasApiTokens, HasFactory, Notifiable;',
                $content
            );
            File::put($lawyerModel, $content);
            $fixed[] = "Added Notifiable trait to Lawyer model";
            echo "     ✓ Fixed: Added Notifiable trait\n";
        }
    }
} else {
    $errors[] = "Lawyer model not found";
    echo "   ✗ Lawyer model not found\n";
}

// Check Admin model
$adminModel = 'app/Models/Admin.php';
if (File::exists($adminModel)) {
    $content = File::get($adminModel);
    if (strpos($content, 'Notifiable') !== false) {
        echo "   ✓ Admin model has Notifiable trait\n";
    } else {
        $warnings[] = "Admin model may be missing Notifiable trait";
        echo "   ⚠ Admin model may be missing Notifiable trait\n";
    }
} else {
    $warnings[] = "Admin model not found";
    echo "   ⚠ Admin model not found\n";
}

echo "\n";

// 6. Check Database Migration
echo "6. Checking Database Migration...\n";
$migrationPath = 'database/migrations';
$migrations = File::glob($migrationPath . '/*_create_notifications_table.php');

if (count($migrations) > 0) {
    echo "   ✓ Notifications table migration exists\n";
} else {
    $warnings[] = "Notifications table migration not found (Laravel default should exist)";
    echo "   ⚠ Notifications table migration not found\n";
}

echo "\n";

// 7. Check Notification Sending in Controllers
echo "7. Checking Notification Sending in Controllers...\n";

// Check Client MessageController
$clientMessageController = 'app/Http/Controllers/Client/MessageController.php';
if (File::exists($clientMessageController)) {
    $content = File::get($clientMessageController);
    if (strpos($content, 'notify(new NewMessageNotification') !== false) {
        echo "   ✓ Client MessageController sends notifications\n";
    } else {
        $warnings[] = "Client MessageController may not send notifications";
        echo "   ⚠ Client MessageController may not send notifications\n";
    }
}

// Check Admin MessageController
$adminMessageController = 'app/Http/Controllers/Admin/MessageController.php';
if (File::exists($adminMessageController)) {
    $content = File::get($adminMessageController);
    if (strpos($content, 'notify(new NewMessageNotification') !== false) {
        echo "   ✓ Admin MessageController sends notifications\n";
    } else {
        $warnings[] = "Admin MessageController may not send notifications";
        echo "   ⚠ Admin MessageController may not send notifications\n";
    }
}

// Check PaymentController
$paymentController = 'Modules/BasicPayment/app/Http/Controllers/PaymentController.php';
if (File::exists($paymentController)) {
    $content = File::get($paymentController);
    if (strpos($content, 'NewAppointmentNotification') !== false) {
        echo "   ✓ PaymentController sends appointment notifications\n";
    } else {
        $warnings[] = "PaymentController may not send appointment notifications";
        echo "   ⚠ PaymentController may not send appointment notifications\n";
    }
}

// Check OrderController
$orderController = 'Modules/Order/app/Http/Controllers/OrderController.php';
if (File::exists($orderController)) {
    $content = File::get($orderController);
    if (strpos($content, 'PaymentApprovedNotification') !== false) {
        echo "   ✓ OrderController sends payment approved notifications\n";
    } else {
        $warnings[] = "OrderController may not send payment approved notifications";
        echo "   ⚠ OrderController may not send payment approved notifications\n";
    }
}

echo "\n";

// 8. Check Layout Files
echo "8. Checking Layout Files...\n";

// Check Lawyer layout
$lawyerLayout = 'resources/views/lawyer/master_layout.blade.php';
if (File::exists($lawyerLayout)) {
    $content = File::get($lawyerLayout);
    if (strpos($content, 'notifications.fetch') !== false || strpos($content, 'notification-dropdown') !== false) {
        echo "   ✓ Lawyer layout has notification dropdown\n";
    } else {
        $warnings[] = "Lawyer layout may be missing notification dropdown";
        echo "   ⚠ Lawyer layout may be missing notification dropdown\n";
    }
}

// Check Admin layout
$adminLayout = 'resources/views/admin/master_layout.blade.php';
if (File::exists($adminLayout)) {
    $content = File::get($adminLayout);
    if (strpos($content, 'notifications.fetch') !== false || strpos($content, 'notification-dropdown') !== false) {
        echo "   ✓ Admin layout has notification dropdown\n";
    } else {
        $warnings[] = "Admin layout may be missing notification dropdown";
        echo "   ⚠ Admin layout may be missing notification dropdown\n";
    }
}

echo "\n";

// Summary
echo "========================================\n";
echo "Summary\n";
echo "========================================\n\n";

if (count($fixed) > 0) {
    echo "Fixed Issues:\n";
    foreach ($fixed as $fix) {
        echo "  ✓ {$fix}\n";
    }
    echo "\n";
}

if (count($errors) > 0) {
    echo "Errors Found:\n";
    foreach ($errors as $error) {
        echo "  ✗ {$error}\n";
    }
    echo "\n";
}

if (count($warnings) > 0) {
    echo "Warnings:\n";
    foreach ($warnings as $warning) {
        echo "  ⚠ {$warning}\n";
    }
    echo "\n";
}

if (count($errors) == 0 && count($warnings) == 0) {
    echo "✓ All checks passed! Notifications system is properly configured.\n\n";
} elseif (count($errors) == 0) {
    echo "✓ No critical errors found. Some warnings may need attention.\n\n";
} else {
    echo "✗ Some errors were found. Please review and fix them.\n\n";
}

echo "========================================\n";
echo "Test Complete\n";
echo "========================================\n";

