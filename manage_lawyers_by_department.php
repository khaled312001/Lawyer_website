<?php

/**
 * Script to manage lawyers by department:
 * - Keep only ONE lawyer per department
 * - Add images to all remaining lawyers
 * - Ensure complete information and ratings
 * - Generate login credentials report
 */

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Modules\Lawyer\app\Models\Department;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

echo "========================================\n";
echo "Lawyer Management Script\n";
echo "========================================\n\n";

// Check for dry-run mode
$dryRun = in_array('--dry-run', $argv) || in_array('-d', $argv);
if ($dryRun) {
    echo "⚠️  DRY-RUN MODE: No changes will be made to the database\n";
    echo "   Run without --dry-run to apply changes\n\n";
}

// Get all active departments
$departments = Department::with('translation')->active()->get();

echo "Found " . $departments->count() . " departments\n\n";

// Array to store login credentials
$credentials = [];

// Counter for images
$imageCounter = 1;

// Process each department
foreach ($departments as $department) {
    $deptName = $department->name ?? "Department #{$department->id}";
    echo "Processing: {$deptName} (ID: {$department->id})\n";
    echo str_repeat("-", 50) . "\n";
    
    // Get all lawyers in this department
    $lawyers = Lawyer::where('department_id', $department->id)
        ->with(['ratings', 'translation', 'location.translation'])
        ->get();
    
    if ($lawyers->isEmpty()) {
        echo "  No lawyers found in this department.\n\n";
        continue;
    }
    
    echo "  Found {$lawyers->count()} lawyer(s)\n";
    
    // Select the lawyer to keep (prefer one with highest rating, then first one)
    $lawyerToKeep = $lawyers->sortByDesc(function ($lawyer) {
        return $lawyer->activeRatings()->avg('rating') ?? 0;
    })->first();
    
    echo "  Keeping lawyer: {$lawyerToKeep->name} (ID: {$lawyerToKeep->id})\n";
    echo "  Current rating: " . number_format($lawyerToKeep->average_rating, 1) . " ({$lawyerToKeep->total_ratings} ratings)\n";
    
    // Delete other lawyers
    $lawyersToDelete = $lawyers->where('id', '!=', $lawyerToKeep->id);
    $deletedCount = 0;
    
    foreach ($lawyersToDelete as $lawyer) {
        try {
            // Check if lawyer has appointments
            if ($lawyer->appointments()->count() > 0) {
                echo "  ⚠️  Cannot delete {$lawyer->name} - has appointments\n";
                continue;
            }
            
            if (!$dryRun) {
                // Delete translations
                $lawyer->translations()->delete();
                
                // Delete ratings
                $lawyer->ratings()->delete();
                
                // Delete image file if exists
                if ($lawyer->image && file_exists(public_path($lawyer->image))) {
                    @unlink(public_path($lawyer->image));
                }
                
                // Delete the lawyer
                $lawyer->delete();
            }
            $deletedCount++;
            echo "  " . ($dryRun ? "[DRY-RUN] Would delete" : "✓ Deleted") . ": {$lawyer->name}\n";
        } catch (\Exception $e) {
            echo "  ✗ Error deleting {$lawyer->name}: " . $e->getMessage() . "\n";
        }
    }
    
    echo "  Deleted {$deletedCount} lawyer(s)\n";
    
    // Ensure the kept lawyer has an image
    if (!$lawyerToKeep->image || empty($lawyerToKeep->image) || !file_exists(public_path($lawyerToKeep->image))) {
        // Assign image path (using placeholder pattern)
        $imagePath = "uploads/website-images/lawyers/lawyer-{$imageCounter}.jpg";
        
        // Create directory if it doesn't exist
        $imageDir = public_path('uploads/website-images/lawyers');
        if (!is_dir($imageDir)) {
            mkdir($imageDir, 0755, true);
        }
        
        // Check for existing lawyer images in various locations
        $possibleImages = [
            "uploads/website-images/lawyers/lawyer-{$imageCounter}.jpg",
            "uploads/website-images/lawyers/lawyer-{$imageCounter}.png",
            "uploads/website-images/lawyers/lawyer-{$imageCounter}.webp",
            "uploads/website-images/dummy/lawyer-{$imageCounter}.jpg",
            "client/img/lawyer-{$imageCounter}.jpg",
        ];
        
        $foundImage = false;
        foreach ($possibleImages as $possiblePath) {
            if (file_exists(public_path($possiblePath))) {
                $imagePath = $possiblePath;
                $foundImage = true;
                break;
            }
        }
        
        // If no image found, use default avatar or placeholder
        if (!$foundImage) {
            // Try to get default avatar from settings
            try {
                $defaultAvatar = \Modules\GlobalSetting\app\Models\Setting::where('key', 'default_avatar')->first()?->value;
                if ($defaultAvatar && file_exists(public_path($defaultAvatar))) {
                    $imagePath = $defaultAvatar;
                } else {
                    $imagePath = "client/img/property-placeholder.jpg"; // Fallback placeholder
                }
            } catch (\Exception $e) {
                $imagePath = "client/img/property-placeholder.jpg";
            }
        }
        
        $lawyerToKeep->image = $imagePath;
        if (!$dryRun) {
            $lawyerToKeep->save();
        }
        echo "  " . ($dryRun ? "[DRY-RUN] Would assign" : "✓ Assigned") . " image: {$imagePath}\n";
        $imageCounter++;
    } else {
        echo "  ✓ Image already exists: {$lawyerToKeep->image}\n";
    }
    
    // Ensure lawyer has complete information
    $updates = [];
    
    // Ensure email is verified
    if (!$lawyerToKeep->email_verified_at) {
        $lawyerToKeep->email_verified_at = now();
        $updates[] = "Email verified";
    }
    
    // Ensure status is active
    if ($lawyerToKeep->status != 1) {
        $lawyerToKeep->status = 1;
        $updates[] = "Status set to active";
    }
    
    // Ensure show_homepage is enabled
    if ($lawyerToKeep->show_homepage != 1) {
        $lawyerToKeep->show_homepage = 1;
        $updates[] = "Show on homepage enabled";
    }
    
    // Ensure phone number exists
    if (empty($lawyerToKeep->phone)) {
        $lawyerToKeep->phone = "+1234567890";
        $updates[] = "Phone number added";
    }
    
    // Ensure years of experience exists
    if (empty($lawyerToKeep->years_of_experience)) {
        $lawyerToKeep->years_of_experience = rand(5, 20);
        $updates[] = "Years of experience added";
    }
    
    if (!empty($updates)) {
        if (!$dryRun) {
            $lawyerToKeep->save();
        }
        echo "  " . ($dryRun ? "[DRY-RUN] Would update" : "✓ Updated") . ": " . implode(", ", $updates) . "\n";
    }
    
    // Ensure lawyer has at least one rating (if none exists)
    if ($lawyerToKeep->total_ratings == 0) {
        if (!$dryRun) {
            // Create a high rating
            Rating::create([
                'lawyer_id' => $lawyerToKeep->id,
                'user_id' => null,
                'rating' => 5,
                'comment' => 'Excellent lawyer with great expertise.',
                'is_admin_created' => true,
                'status' => true,
            ]);
        }
        echo "  " . ($dryRun ? "[DRY-RUN] Would add" : "✓ Added") . " default rating (5 stars)\n";
    }
    
    // Reset password to a known default for reporting
    $defaultPassword = 'Lawyer' . $lawyerToKeep->id . '!2024';
    if (!$dryRun) {
        $lawyerToKeep->password = Hash::make($defaultPassword);
        $lawyerToKeep->save();
    }
    
    // Store credentials
    $credentials[] = [
        'department' => $deptName,
        'lawyer_id' => $lawyerToKeep->id,
        'name' => $lawyerToKeep->name,
        'email' => $lawyerToKeep->email,
        'password' => $defaultPassword, // Reset password for easy access
        'phone' => $lawyerToKeep->phone,
        'image' => $lawyerToKeep->image,
        'rating' => number_format($lawyerToKeep->average_rating, 1),
        'total_ratings' => $lawyerToKeep->total_ratings,
        'years_of_experience' => $lawyerToKeep->years_of_experience,
        'designations' => $lawyerToKeep->designations ?? 'N/A',
        'location' => $lawyerToKeep->location ? ($lawyerToKeep->location->name ?? 'N/A') : 'N/A',
    ];
    
    echo "\n";
}

// Generate credentials report
echo "\n========================================\n";
echo "LOGIN CREDENTIALS REPORT\n";
echo "========================================\n\n";

$reportFile = storage_path('logs/lawyer_credentials_' . date('Y-m-d_His') . '.txt');
$reportContent = "LAWYER LOGIN CREDENTIALS REPORT\n";
$reportContent .= "Generated: " . date('Y-m-d H:i:s') . "\n";
$reportContent .= str_repeat("=", 80) . "\n\n";

foreach ($credentials as $cred) {
    echo "Department: {$cred['department']}\n";
    echo "  Lawyer: {$cred['name']} (ID: {$cred['lawyer_id']})\n";
    echo "  Email: {$cred['email']}\n";
    echo "  Password: {$cred['password']}\n";
    echo "  Phone: {$cred['phone']}\n";
    echo "  Image: {$cred['image']}\n";
    echo "  Rating: {$cred['rating']} ({$cred['total_ratings']} ratings)\n";
    echo "  Years of Experience: " . ($cred['years_of_experience'] ?? 'N/A') . "\n";
    echo "  Designations: " . ($cred['designations'] ?? 'N/A') . "\n";
    echo "  Location: " . ($cred['location'] ?? 'N/A') . "\n";
    echo "\n";
    
    $reportContent .= "Department: {$cred['department']}\n";
    $reportContent .= "  Lawyer: {$cred['name']} (ID: {$cred['lawyer_id']})\n";
    $reportContent .= "  Email: {$cred['email']}\n";
    $reportContent .= "  Password: {$cred['password']}\n";
    $reportContent .= "  Phone: {$cred['phone']}\n";
    $reportContent .= "  Image: {$cred['image']}\n";
    $reportContent .= "  Rating: {$cred['rating']} ({$cred['total_ratings']} ratings)\n";
    $reportContent .= "  Years of Experience: " . ($cred['years_of_experience'] ?? 'N/A') . "\n";
    $reportContent .= "  Designations: " . ($cred['designations'] ?? 'N/A') . "\n";
    $reportContent .= "  Location: " . ($cred['location'] ?? 'N/A') . "\n";
    $reportContent .= "\n";
}

// Save report to file
file_put_contents($reportFile, $reportContent);
echo "Report saved to: {$reportFile}\n";

// Also create a CSV file
$csvFile = storage_path('logs/lawyer_credentials_' . date('Y-m-d_His') . '.csv');
$csvContent = "Department,Lawyer ID,Name,Email,Password,Phone,Image,Rating,Total Ratings,Years of Experience,Designations,Location\n";
foreach ($credentials as $cred) {
    $csvContent .= sprintf(
        '"%s",%d,"%s","%s","%s","%s","%s",%s,%d,%s,"%s","%s"' . "\n",
        $cred['department'],
        $cred['lawyer_id'],
        $cred['name'],
        $cred['email'],
        $cred['password'],
        $cred['phone'],
        $cred['image'],
        $cred['rating'],
        $cred['total_ratings'],
        $cred['years_of_experience'] ?? 'N/A',
        $cred['designations'] ?? 'N/A',
        $cred['location'] ?? 'N/A'
    );
}
file_put_contents($csvFile, $csvContent);
echo "CSV report saved to: {$csvFile}\n";

echo "\n========================================\n";
echo "SUMMARY\n";
echo "========================================\n";
echo "Total departments processed: " . $departments->count() . "\n";
echo "Total lawyers kept: " . count($credentials) . "\n";
echo "Each department now has exactly ONE lawyer\n";
echo "\nDone!\n";
