<?php
/**
 * Diagnostic script to check uploads directory structure and permissions
 * Run this from your Laravel root: php check_uploads.php
 */

$basePath = __DIR__;
$publicPath = $basePath . '/public';
$uploadsPath = $publicPath . '/uploads';
$customImagesPath = $uploadsPath . '/custom-images';
$storagePath = $basePath . '/storage/app/public';
$publicStorageLink = $publicPath . '/storage';

echo "========================================\n";
echo "  Laravel Uploads Directory Diagnostic\n";
echo "========================================\n\n";

// Check public directory
echo "1. Checking public directory...\n";
if (is_dir($publicPath)) {
    echo "   ✓ public/ exists\n";
    echo "   Permissions: " . substr(sprintf('%o', fileperms($publicPath)), -4) . "\n";
} else {
    echo "   ✗ public/ does NOT exist!\n";
}

// Check uploads directory
echo "\n2. Checking uploads directory...\n";
if (is_dir($uploadsPath)) {
    echo "   ✓ public/uploads/ exists\n";
    echo "   Permissions: " . substr(sprintf('%o', fileperms($uploadsPath)), -4) . "\n";
} else {
    echo "   ✗ public/uploads/ does NOT exist!\n";
    echo "   Creating directory...\n";
    if (mkdir($uploadsPath, 0755, true)) {
        echo "   ✓ Created public/uploads/\n";
    } else {
        echo "   ✗ Failed to create directory\n";
    }
}

// Check custom-images directory
echo "\n3. Checking custom-images directory...\n";
if (is_dir($customImagesPath)) {
    echo "   ✓ public/uploads/custom-images/ exists\n";
    echo "   Permissions: " . substr(sprintf('%o', fileperms($customImagesPath)), -4) . "\n";
    
    // List some files
    $files = glob($customImagesPath . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
    echo "   Files found: " . count($files) . "\n";
    if (count($files) > 0) {
        echo "   Sample files:\n";
        foreach (array_slice($files, 0, 5) as $file) {
            $filename = basename($file);
            $size = filesize($file);
            echo "     - $filename (" . number_format($size / 1024, 2) . " KB)\n";
        }
    }
} else {
    echo "   ✗ public/uploads/custom-images/ does NOT exist!\n";
    echo "   Creating directory...\n";
    if (mkdir($customImagesPath, 0755, true)) {
        echo "   ✓ Created public/uploads/custom-images/\n";
    } else {
        echo "   ✗ Failed to create directory\n";
    }
}

// Check storage directory
echo "\n4. Checking storage directory...\n";
if (is_dir($storagePath)) {
    echo "   ✓ storage/app/public/ exists\n";
    echo "   Permissions: " . substr(sprintf('%o', fileperms($storagePath)), -4) . "\n";
} else {
    echo "   ✗ storage/app/public/ does NOT exist!\n";
    echo "   Creating directory...\n";
    if (mkdir($storagePath, 0755, true)) {
        echo "   ✓ Created storage/app/public/\n";
    } else {
        echo "   ✗ Failed to create directory\n";
    }
}

// Check symlink
echo "\n5. Checking storage symlink...\n";
if (is_link($publicStorageLink)) {
    $target = readlink($publicStorageLink);
    echo "   ✓ public/storage is a symlink\n";
    echo "   Points to: $target\n";
    if (file_exists($publicStorageLink)) {
        echo "   ✓ Symlink target is accessible\n";
    } else {
        echo "   ✗ Symlink target is NOT accessible!\n";
    }
} elseif (is_dir($publicStorageLink)) {
    echo "   ⚠ public/storage exists but is NOT a symlink (it's a directory)\n";
    echo "   You may need to remove it and create a symlink instead\n";
} else {
    echo "   ✗ public/storage does NOT exist\n";
    echo "   You need to create a symlink:\n";
    echo "   ln -s ../storage/app/public public/storage\n";
}

// Check for nested directories (bug indicator)
echo "\n6. Checking for nested directory issues...\n";
$nestedPath = $customImagesPath . '/uploads/custom-images';
if (is_dir($nestedPath)) {
    echo "   ⚠ WARNING: Found nested directory: uploads/custom-images/uploads/custom-images/\n";
    echo "   This indicates a bug in the file_upload() function\n";
    $nestedFiles = glob($nestedPath . '/*');
    echo "   Files in nested directory: " . count($nestedFiles) . "\n";
} else {
    echo "   ✓ No nested directory issues found\n";
}

// Check PHP functions
echo "\n7. Checking PHP functions...\n";
if (function_exists('symlink')) {
    echo "   ✓ symlink() function is available\n";
} else {
    echo "   ✗ symlink() function is DISABLED\n";
    echo "   You'll need to use shell commands or the custom command\n";
}

echo "\n========================================\n";
echo "  Diagnostic Complete\n";
echo "========================================\n";

