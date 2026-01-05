<?php
/**
 * سكربت لتحديث ترجمات الأيام بالعربية
 * 
 * طريقة الاستخدام:
 * php update_days_arabic_translations.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Modules\Day\app\Models\Day;
use Modules\Day\app\Models\DayTranslation;

echo "🚀 بدء تحديث ترجمات الأيام بالعربية...\n";
echo "════════════════════════════════════════════════\n\n";

// ترجمات الأيام بالعربية
$daysTranslations = [
    'friday' => 'الجمعة',
    'saturday' => 'السبت',
    'sunday' => 'الأحد',
    'monday' => 'الإثنين',
    'tuesday' => 'الثلاثاء',
    'wednesday' => 'الأربعاء',
    'thursday' => 'الخميس',
];

$updated = 0;
$created = 0;

foreach ($daysTranslations as $slug => $arabicTitle) {
    $day = Day::where('slug', $slug)->first();
    
    if (!$day) {
        echo "⚠️  تحذير: لم يتم العثور على يوم: {$slug}\n";
        continue;
    }
    
    // البحث عن ترجمة عربية موجودة
    $translation = DayTranslation::where('day_id', $day->id)
        ->where('lang_code', 'ar')
        ->first();
    
    if ($translation) {
        // تحديث الترجمة الموجودة
        $translation->update(['title' => $arabicTitle]);
        echo "✅ تم تحديث: {$slug} -> {$arabicTitle}\n";
        $updated++;
    } else {
        // إنشاء ترجمة جديدة
        DayTranslation::create([
            'day_id' => $day->id,
            'lang_code' => 'ar',
            'title' => $arabicTitle,
        ]);
        echo "➕ تم إنشاء: {$slug} -> {$arabicTitle}\n";
        $created++;
    }
}

echo "\n";
echo "════════════════════════════════════════════════\n";
echo "✅ تم الانتهاء بنجاح!\n\n";
echo "📊 ملخص النتائج:\n";
echo "   • الترجمات المحدثة: {$updated}\n";
echo "   • الترجمات الجديدة: {$created}\n";
echo "   • المجموع: " . ($updated + $created) . "\n";
echo "════════════════════════════════════════════════\n";

