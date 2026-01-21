<?php

/**
 * Update Office Address
 * تحديث عنوان المكتب
 * 
 * Usage: php update_address.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Modules\ContactMessage\app\Models\ContactInfo;

try {
    // العنوان الجديد
    $newAddress = 'Europaallee 19, 8004 Zürich';
    
    // البحث عن سجل ContactInfo
    $contactInfo = ContactInfo::first();
    
    if (!$contactInfo) {
        // إنشاء سجل جديد إذا لم يكن موجوداً
        $contactInfo = new ContactInfo();
        $contactInfo->save();
        echo "✓ تم إنشاء سجل جديد لمعلومات الاتصال\n";
    }
    
    // تحديث العنوان
    $contactInfo->address = $newAddress;
    $contactInfo->save();
    
    // مسح الكاش
    cache()->forget('contactInfo');
    
    echo "✓ تم تحديث عنوان المكتب بنجاح!\n";
    echo "العنوان الجديد: {$newAddress}\n";
    echo "\n";
    echo "تم مسح الكاش تلقائياً.\n";
    
} catch (Exception $e) {
    echo "✗ حدث خطأ: " . $e->getMessage() . "\n";
    exit(1);
}
