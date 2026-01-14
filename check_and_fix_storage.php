<?php
/**
 * Check and Fix Storage Link
 * 
 * This script checks if storage link exists and fixes it if needed.
 * Also verifies that real estate images are accessible.
 * 
 * Usage: php check_and_fix_storage.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Modules\RealEstate\app\Models\RealEstate;
use Illuminate\Support\Facades\File;

echo "========================================\n";
echo "  Storage Link Checker & Fixer\n";
echo "========================================\n\n";

$link = public_path('storage');
$target = storage_path('app/public');

echo "Checking storage link...\n";
echo "Link: {$link}\n";
echo "Target: {$target}\n\n";

// Check if target exists
if (!is_dir($target)) {
    echo "⚠ Target directory does not exist. Creating it...\n";
    File::makeDirectory($target, 0755, true);
    echo "✓ Created target directory\n\n";
}

// Check link status
$linkExists = file_exists($link) || is_link($link);
$isLink = is_link($link);
$isDir = is_dir($link) && !is_link($link);

echo "Link Status:\n";
echo "  Exists: " . ($linkExists ? "Yes" : "No") . "\n";
echo "  Is Link: " . ($isLink ? "Yes" : "No") . "\n";
echo "  Is Directory: " . ($isDir ? "Yes" : "No") . "\n\n";

// Check if link is broken or circular
if ($isLink) {
    $linkTarget = readlink($link);
    echo "Link Target: {$linkTarget}\n";
    
    if ($linkTarget === false) {
        echo "⚠ Link is broken!\n";
    } elseif (!file_exists($linkTarget)) {
        echo "⚠ Link target does not exist!\n";
    } else {
        echo "✓ Link is valid\n";
    }
    echo "\n";
}

// Check real estate images
echo "Checking real estate images...\n";
$properties = RealEstate::all();
$imagesFound = 0;
$imagesMissing = 0;

foreach ($properties as $property) {
    if ($property->featured_image) {
        $imagePath = $property->featured_image;
        $fullPath1 = storage_path('app/public/' . $imagePath);
        $fullPath2 = public_path('storage/' . $imagePath);
        
        if (file_exists($fullPath1)) {
            $imagesFound++;
        } elseif (file_exists($fullPath2)) {
            $imagesFound++;
        } else {
            $imagesMissing++;
            echo "  Missing: {$imagePath}\n";
        }
    }
    
    if ($property->images && is_array($property->images)) {
        foreach ($property->images as $image) {
            if (is_string($image) && !str_starts_with($image, 'http')) {
                $fullPath1 = storage_path('app/public/' . $image);
                $fullPath2 = public_path('storage/' . $image);
                
                if (!file_exists($fullPath1) && !file_exists($fullPath2)) {
                    $imagesMissing++;
                } else {
                    $imagesFound++;
                }
            }
        }
    }
}

echo "\nImage Statistics:\n";
echo "  Found: {$imagesFound}\n";
echo "  Missing: {$imagesMissing}\n\n";

// Check real-estate directory
$realEstateDir = storage_path('app/public/real-estate');
echo "Checking real-estate directory...\n";
if (is_dir($realEstateDir)) {
    $files = glob($realEstateDir . '/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
    echo "  Files in storage: " . count($files) . "\n";
    if (count($files) > 0) {
        echo "  Sample files:\n";
        foreach (array_slice($files, 0, 3) as $file) {
            echo "    - " . basename($file) . " (" . number_format(filesize($file) / 1024, 2) . " KB)\n";
        }
    }
} else {
    echo "  ⚠ Directory does not exist: {$realEstateDir}\n";
}

echo "\n========================================\n";
echo "  Recommendations\n";
echo "========================================\n";

if (!$linkExists || ($isLink && !file_exists(readlink($link)))) {
    echo "1. Remove broken link/directory:\n";
    echo "   rm -rf {$link}\n\n";
    echo "2. Create new symlink:\n";
    echo "   ln -s " . escapeshellarg($target) . " " . escapeshellarg($link) . "\n\n";
} elseif ($isDir) {
    echo "⚠ Storage is a directory, not a symlink.\n";
    echo "This works but files need to be in both locations.\n";
    echo "Consider creating a symlink instead.\n\n";
} else {
    echo "✓ Storage link appears to be working correctly.\n\n";
}

if ($imagesMissing > 0) {
    echo "⚠ Some images are missing. Run:\n";
    echo "   php artisan app:add-real-estate-images --force\n\n";
} else {
    echo "✓ All images appear to be present.\n\n";
}

echo "To verify images are accessible, check:\n";
echo "  - Storage: {$realEstateDir}\n";
echo "  - Public link: {$link}/real-estate\n";
echo "\n";
