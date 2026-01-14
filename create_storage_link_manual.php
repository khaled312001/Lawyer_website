<?php
/**
 * Manual Storage Link Creator
 * 
 * This script creates a storage link manually when symlink() function is disabled.
 * It will try multiple methods to create the link.
 * 
 * Usage: php create_storage_link_manual.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$link = public_path('storage');
$target = storage_path('app/public');

echo "========================================\n";
echo "  Manual Storage Link Creator\n";
echo "========================================\n\n";

echo "Link: {$link}\n";
echo "Target: {$target}\n\n";

// Ensure target directory exists
if (!is_dir($target)) {
    echo "Creating target directory: {$target}\n";
    mkdir($target, 0755, true);
}

// Remove existing link/directory if exists
if (file_exists($link) || is_link($link)) {
    echo "Removing existing link/directory...\n";
    if (is_link($link)) {
        unlink($link);
    } elseif (is_dir($link)) {
        // Try to remove directory (only if empty)
        @rmdir($link);
        if (is_dir($link)) {
            echo "Warning: Directory exists and is not empty. You may need to remove it manually.\n";
        }
    } else {
        unlink($link);
    }
}

$success = false;

// Method 1: Try PHP symlink() if available
if (function_exists('symlink')) {
    echo "\nMethod 1: Trying PHP symlink()...\n";
    try {
        if (@symlink($target, $link)) {
            $success = true;
            echo "✓ Successfully created symlink using PHP symlink()\n";
        } else {
            echo "✗ PHP symlink() failed\n";
        }
    } catch (\Exception $e) {
        echo "✗ PHP symlink() exception: " . $e->getMessage() . "\n";
    }
}

// Method 2: Try shell command
if (!$success) {
    echo "\nMethod 2: Trying shell command (ln -s)...\n";
    $absoluteTarget = realpath($target);
    
    if (!$absoluteTarget) {
        echo "✗ Target path does not exist: {$target}\n";
    } else {
        $command = "ln -s " . escapeshellarg($absoluteTarget) . " " . escapeshellarg($link) . " 2>&1";
        $output = [];
        $returnVar = 0;
        @exec($command, $output, $returnVar);
        
        if ($returnVar === 0 && (is_link($link) || file_exists($link))) {
            $success = true;
            echo "✓ Successfully created symlink using shell command\n";
        } else {
            $error = implode("\n", $output);
            echo "✗ Shell command failed\n";
            echo "Error output: {$error}\n";
        }
    }
}

// Method 3: Create directory and copy structure (fallback)
if (!$success) {
    echo "\nMethod 3: Creating directory structure (fallback method)...\n";
    echo "Note: This creates a real directory instead of a symlink.\n";
    echo "Files will need to be manually synced or uploaded to both locations.\n\n";
    
    if (!is_dir($link)) {
        if (@mkdir($link, 0755, true)) {
            echo "✓ Created directory: {$link}\n";
            echo "\n⚠ IMPORTANT: This is a directory, not a symlink.\n";
            echo "You may need to:\n";
            echo "1. Manually copy files from {$target} to {$link}\n";
            echo "2. Or configure your application to use {$target} directly\n";
            echo "3. Or contact your hosting provider to enable symlink() function\n";
        } else {
            echo "✗ Failed to create directory\n";
        }
    } else {
        echo "✓ Directory already exists: {$link}\n";
    }
}

echo "\n========================================\n";
echo "  Summary\n";
echo "========================================\n";

if ($success || is_dir($link)) {
    echo "Status: ✓ Storage link/directory is ready\n";
    echo "\nNext steps:\n";
    echo "1. Run: php artisan app:add-real-estate-images --force\n";
    echo "2. Check that images appear in: {$link}\n";
    echo "3. Verify images display correctly on the website\n";
} else {
    echo "Status: ✗ Failed to create storage link\n";
    echo "\nManual steps:\n";
    echo "1. SSH into your server\n";
    echo "2. Run: ln -s " . escapeshellarg(realpath($target)) . " " . escapeshellarg($link) . "\n";
    echo "3. Or contact your hosting provider to enable symlink() function\n";
}

echo "\n";
