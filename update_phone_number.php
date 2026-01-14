<?php
/**
 * Update Phone Number Script
 * 
 * This script updates the official phone number to +41795578786
 * in all contact_info records in the database.
 * 
 * Usage: php update_phone_number.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Modules\ContactMessage\app\Models\ContactInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

echo "========================================\n";
echo "  Update Phone Number Script\n";
echo "========================================\n\n";

$newPhoneNumber = '+41795578786';

try {
    $updatedCount = 0;
    
    // Update contact_infos table
    echo "1. Updating contact_infos table...\n";
    $contactInfos = ContactInfo::all();
    
    if ($contactInfos->isEmpty()) {
        echo "   ⚠ No contact info records found. Creating new record...\n";
        
        $contactInfo = new ContactInfo();
        $contactInfo->top_bar_phone = $newPhoneNumber;
        $contactInfo->phone = $newPhoneNumber;
        $contactInfo->save();
        
        echo "   ✓ Created new contact info with phone number: {$newPhoneNumber}\n";
        $updatedCount++;
    } else {
        foreach ($contactInfos as $contactInfo) {
            $oldTopBarPhone = $contactInfo->top_bar_phone;
            $oldPhone = $contactInfo->phone;
            
            $contactInfo->top_bar_phone = $newPhoneNumber;
            $contactInfo->phone = $newPhoneNumber;
            $contactInfo->save();
            
            echo "   Updated Contact Info ID: {$contactInfo->id}\n";
            echo "     Top Bar Phone: {$oldTopBarPhone} → {$newPhoneNumber}\n";
            echo "     Phone: {$oldPhone} → {$newPhoneNumber}\n";
            
            $updatedCount++;
        }
        echo "   ✓ Updated {$updatedCount} contact info record(s)\n";
    }
    
    // Update settings table (prescription_phone)
    echo "\n2. Updating settings table (prescription_phone)...\n";
    $prescriptionPhoneSetting = DB::table('settings')->where('key', 'prescription_phone')->first();
    
    if ($prescriptionPhoneSetting) {
        $oldPrescriptionPhone = $prescriptionPhoneSetting->value;
        DB::table('settings')
            ->where('key', 'prescription_phone')
            ->update(['value' => $newPhoneNumber]);
        
        echo "   Updated prescription_phone setting\n";
        echo "     Old: {$oldPrescriptionPhone} → New: {$newPhoneNumber}\n";
        echo "   ✓ Updated prescription_phone setting\n";
    } else {
        echo "   ⚠ prescription_phone setting not found. Creating new setting...\n";
        DB::table('settings')->insert([
            'key' => 'prescription_phone',
            'value' => $newPhoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        echo "   ✓ Created prescription_phone setting\n";
    }
    
    // Clear cache
    echo "\n3. Clearing cache...\n";
    Cache::forget('contactInfo');
    Cache::forget('setting');
    echo "   ✓ Cleared contact info and settings cache\n";
    
    echo "\n========================================\n";
    echo "  Summary\n";
    echo "========================================\n";
    echo "New phone number: {$newPhoneNumber}\n";
    echo "Contact info records updated: {$updatedCount}\n";
    echo "Status: ✓ Success\n\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
