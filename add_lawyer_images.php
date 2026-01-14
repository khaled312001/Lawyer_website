<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Modules\GlobalSetting\app\Models\Setting;
use Illuminate\Support\Facades\File;

echo "=== إضافة صور للمحاميين الذين لا يملكون صوراً ===\n\n";

try {
    // الحصول على جميع المحاميين
    $lawyers = Lawyer::all();
    $updatedCount = 0;
    $skippedCount = 0;

    // الحصول على الصورة الافتراضية من الإعدادات
    $defaultAvatar = Setting::where('key', 'default_avatar')->first()?->value;
    $defaultAvatarPath = $defaultAvatar && File::exists(public_path($defaultAvatar)) 
        ? $defaultAvatar 
        : 'uploads/website-images/default-avatar.png';

    // قائمة بصور المحاميين المتاحة
    $availableLawyerImages = [
        'uploads/website-images/dummy/lawyer-1.webp',
        'uploads/website-images/dummy/lawyer-2.webp',
        'uploads/website-images/dummy/lawyer-3.webp',
        'uploads/website-images/dummy/lawyer-4.webp',
        'uploads/website-images/dummy/lawyer-5.webp',
        'uploads/website-images/dummy/lawyer-6.webp',
        'uploads/website-images/dummy/lawyer-7.webp',
        'uploads/website-images/dummy/lawyer-8.webp',
        'uploads/website-images/dummy/lawyer-9.webp',
        'uploads/website-images/dummy/lawyer-10.webp',
    ];

    // فلترة الصور المتاحة فعلياً
    $existingImages = [];
    foreach ($availableLawyerImages as $imagePath) {
        if (File::exists(public_path($imagePath))) {
            $existingImages[] = $imagePath;
        }
    }

    if (empty($existingImages)) {
        echo "⚠️  لم يتم العثور على صور محاميين في المجلد المحدد.\n";
        echo "سيتم استخدام الصورة الافتراضية: {$defaultAvatarPath}\n\n";
    } else {
        echo "✓ تم العثور على " . count($existingImages) . " صورة محامي متاحة\n\n";
    }

    $imageIndex = 0;

    foreach ($lawyers as $lawyer) {
        // التحقق من وجود صورة للمحامي
        $needsImage = false;
        
        if (empty($lawyer->image)) {
            $needsImage = true;
        } elseif (!File::exists(public_path($lawyer->image))) {
            $needsImage = true;
        }
        
        if ($needsImage) {
            // اختيار صورة من القائمة المتاحة
            if (!empty($existingImages)) {
                $selectedImage = $existingImages[$imageIndex % count($existingImages)];
                $lawyer->image = $selectedImage;
                $imageIndex++;
            } else {
                // استخدام الصورة الافتراضية
                $lawyer->image = $defaultAvatarPath;
            }
            
            $lawyer->save();
            $updatedCount++;
            echo "✓ تم تحديث صورة المحامي: {$lawyer->name} -> {$lawyer->image}\n";
        } else {
            $skippedCount++;
            echo "- تم تخطي المحامي: {$lawyer->name} (لديه صورة بالفعل: {$lawyer->image})\n";
        }
    }

    echo "\n=== النتائج ===\n";
    echo "تم تحديث: {$updatedCount} محامي\n";
    echo "تم تخطي: {$skippedCount} محامي\n";
    echo "\nتم الانتهاء بنجاح! ✅\n";
    
} catch (\Exception $e) {
    echo "❌ حدث خطأ: " . $e->getMessage() . "\n";
    echo "الملف: " . $e->getFile() . "\n";
    echo "السطر: " . $e->getLine() . "\n";
    exit(1);
}
