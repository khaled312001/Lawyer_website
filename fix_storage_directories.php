<?php
/**
 * Fix Laravel Storage Directories
 * 
 * This script ensures all required Laravel storage directories exist
 * with proper permissions. Run this after deployment or when you see
 * storage-related errors.
 * 
 * Usage: php fix_storage_directories.php
 */

$basePath = __DIR__;
$storagePath = $basePath . '/storage';
$frameworkPath = $storagePath . '/framework';
$sessionsPath = $frameworkPath . '/sessions';
$cachePath = $frameworkPath . '/cache';
$viewsPath = $frameworkPath . '/views';
$testingPath = $frameworkPath . '/testing';
$logsPath = $storagePath . '/logs';
$appPath = $storagePath . '/app';
$appPublicPath = $appPath . '/public';

echo "========================================\n";
echo "  Laravel Storage Directories Fix\n";
echo "========================================\n\n";

$directories = [
    'storage' => $storagePath,
    'storage/framework' => $frameworkPath,
    'storage/framework/sessions' => $sessionsPath,
    'storage/framework/cache' => $cachePath,
    'storage/framework/views' => $viewsPath,
    'storage/framework/testing' => $testingPath,
    'storage/logs' => $logsPath,
    'storage/app' => $appPath,
    'storage/app/public' => $appPublicPath,
];

$created = 0;
$exists = 0;
$failed = 0;

foreach ($directories as $name => $path) {
    echo "Checking {$name}...\n";
    
    if (is_dir($path)) {
        echo "  ✓ Directory exists\n";
        $exists++;
        
        // Check permissions
        $perms = substr(sprintf('%o', fileperms($path)), -4);
        echo "  Permissions: {$perms}\n";
        
        // Try to make it writable if needed
        if (!is_writable($path)) {
            echo "  ⚠ Directory is not writable, attempting to fix...\n";
            if (@chmod($path, 0755)) {
                echo "  ✓ Fixed permissions\n";
            } else {
                echo "  ✗ Could not fix permissions (may need manual fix)\n";
            }
        }
    } else {
        echo "  ✗ Directory does NOT exist\n";
        echo "  Creating directory...\n";
        
        if (@mkdir($path, 0755, true)) {
            echo "  ✓ Created successfully\n";
            $created++;
        } else {
            echo "  ✗ Failed to create directory\n";
            $failed++;
        }
    }
    echo "\n";
}

// Create .gitignore files if they don't exist
$gitignoreFiles = [
    $sessionsPath => "*.php\n",
    $cachePath => "*\n!.gitignore\n",
    $viewsPath => "*\n!.gitignore\n",
    $testingPath => "*\n!.gitignore\n",
    $logsPath => "*.log\n",
    $appPublicPath => "*\n!.gitignore\n",
];

foreach ($gitignoreFiles as $dir => $content) {
    if (is_dir($dir)) {
        $gitignorePath = $dir . '/.gitignore';
        if (!file_exists($gitignorePath)) {
            if (@file_put_contents($gitignorePath, $content)) {
                echo "Created .gitignore in " . basename($dir) . "\n";
            }
        }
    }
}

echo "========================================\n";
echo "  Summary\n";
echo "========================================\n";
echo "Directories that existed: {$exists}\n";
echo "Directories created: {$created}\n";
echo "Directories failed: {$failed}\n\n";

if ($failed > 0) {
    echo "⚠ WARNING: Some directories could not be created.\n";
    echo "You may need to create them manually or check permissions.\n";
    exit(1);
} else {
    echo "✓ All storage directories are ready!\n";
    exit(0);
}
