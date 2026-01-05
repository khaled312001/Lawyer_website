<?php
/**
 * Fix uploads directory permissions and verify setup
 * Run this from your Laravel root: php fix_uploads_permissions.php
 */

$basePath = __DIR__;
$uploadsPath = $basePath . '/public/uploads';
$customImagesPath = $uploadsPath . '/custom-images';

echo "========================================\n";
echo "  Fixing Uploads Directory Permissions\n";
echo "========================================\n\n";

// Fix permissions
$directories = [
    $uploadsPath => 0755,
    $customImagesPath => 0755,
];

foreach ($directories as $dir => $perms) {
    if (is_dir($dir)) {
        if (chmod($dir, $perms)) {
            echo "✓ Set permissions on " . basename($dir) . " to " . sprintf('%o', $perms) . "\n";
        } else {
            echo "✗ Failed to set permissions on " . basename($dir) . "\n";
        }
    } else {
        echo "⚠ Directory does not exist: " . basename($dir) . "\n";
    }
}

// Test write permissions
echo "\nTesting write permissions...\n";
$testFile = $customImagesPath . '/.test_write';
if (is_writable($customImagesPath)) {
    echo "✓ Directory is writable\n";
    // Try to create a test file
    if (@file_put_contents($testFile, 'test')) {
        echo "✓ Can create files\n";
        unlink($testFile);
        echo "✓ Can delete files\n";
    } else {
        echo "✗ Cannot create files (check permissions)\n";
    }
} else {
    echo "✗ Directory is NOT writable\n";
    echo "  Try running: chmod 775 public/uploads/custom-images\n";
}

echo "\n========================================\n";
echo "  Setup Complete\n";
echo "========================================\n";
echo "\nNext steps:\n";
echo "1. Upload a test image through your application\n";
echo "2. Check if it appears in: public/uploads/custom-images/\n";
echo "3. Verify the image is accessible via browser\n";
echo "\nIf images still return 404:\n";
echo "- Check web server user has read permissions\n";
echo "- Verify .htaccess allows access to uploads directory\n";
echo "- Check if images exist in database but files are missing\n";

