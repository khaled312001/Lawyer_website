<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\ContactMessage\app\Models\ContactInfo;

echo "=== تحديث الإيميل إلى info@amanlaw.ch ===\n\n";

try {
    // الحصول على سجل ContactInfo الأول (عادة يكون واحد فقط)
    $contactInfo = ContactInfo::first();
    
    if (!$contactInfo) {
        echo "❌ لم يتم العثور على سجل معلومات الاتصال.\n";
        echo "سيتم إنشاء سجل جديد...\n";
        $contactInfo = ContactInfo::create([
            'top_bar_email' => 'info@amanlaw.ch',
            'email' => 'info@amanlaw.ch',
        ]);
        echo "✓ تم إنشاء سجل جديد مع الإيميل: info@amanlaw.ch\n";
    } else {
        $oldTopBarEmail = $contactInfo->top_bar_email;
        $oldEmail = $contactInfo->email;
        
        echo "الإيميل الحالي في الهيدر (top_bar_email): " . ($oldTopBarEmail ?: 'غير محدد') . "\n";
        echo "الإيميل الحالي (email): " . ($oldEmail ?: 'غير محدد') . "\n\n";
        
        // تحديث الإيميل
        $contactInfo->top_bar_email = 'info@amanlaw.ch';
        $contactInfo->email = 'info@amanlaw.ch';
        $contactInfo->save();
        
        echo "✓ تم تحديث الإيميل بنجاح!\n";
        echo "  - top_bar_email: {$oldTopBarEmail} -> info@amanlaw.ch\n";
        echo "  - email: {$oldEmail} -> info@amanlaw.ch\n";
    }
    
    echo "\nتم الانتهاء بنجاح! ✅\n";
    
} catch (\Exception $e) {
    echo "❌ حدث خطأ: " . $e->getMessage() . "\n";
    echo "الملف: " . $e->getFile() . "\n";
    echo "السطر: " . $e->getLine() . "\n";
    exit(1);
}
