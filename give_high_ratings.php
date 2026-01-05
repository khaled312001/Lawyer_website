<?php
/**
 * سكربت لإعطاء تقييم عالي لكل المحاميين
 * 
 * طريقة الاستخدام:
 * php give_high_ratings.php
 * 
 * أو مع خيارات:
 * php give_high_ratings.php --rating=5 --count=3
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Admin;
use App\Models\Rating;
use Modules\Lawyer\app\Models\Lawyer;

// إعدادات افتراضية
$ratingValue = 5; // التقييم (1-5)
$countPerLawyer = 1; // عدد التقييمات لكل محامي
$force = false; // حذف التقييمات الموجودة أولاً

// قراءة الخيارات من سطر الأوامر
$options = getopt('', ['rating:', 'count:', 'force']);

if (isset($options['rating'])) {
    $ratingValue = (int) $options['rating'];
}

if (isset($options['count'])) {
    $countPerLawyer = (int) $options['count'];
}

if (isset($options['force'])) {
    $force = true;
}

// التحقق من قيمة التقييم
if ($ratingValue < 1 || $ratingValue > 5) {
    echo "❌ خطأ: التقييم يجب أن يكون بين 1 و 5\n";
    exit(1);
}

echo "🚀 بدء عملية إعطاء التقييمات العالية للمحاميين...\n";
echo "════════════════════════════════════════════════\n\n";

// الحصول على أول أدمن
$admin = Admin::first();
if (!$admin) {
    echo "❌ خطأ: لا يوجد أدمن في قاعدة البيانات. يرجى إنشاء أدمن أولاً.\n";
    exit(1);
}

echo "✅ تم العثور على الأدمن: {$admin->name} (ID: {$admin->id})\n\n";

// الحصول على جميع المحاميين النشطين
$lawyers = Lawyer::where('status', 'active')->get();

if ($lawyers->isEmpty()) {
    echo "⚠️  تحذير: لا يوجد محاميين نشطين في قاعدة البيانات.\n";
    exit(0);
}

echo "📊 تم العثور على {$lawyers->count()} محامي نشط\n";
echo "⭐ قيمة التقييم: {$ratingValue} / 5\n";
echo "📝 عدد التقييمات لكل محامي: {$countPerLawyer}\n";
echo "🔄 حذف التقييمات الموجودة: " . ($force ? 'نعم' : 'لا') . "\n\n";

$totalRatingsCreated = 0;
$totalRatingsUpdated = 0;
$skipped = 0;

// التعليقات العشوائية
$comments = [
    5 => [
        'محامي ممتاز ومحترف جداً',
        'خدمة رائعة ومهنية عالية',
        'خبرة واسعة وأداء متميز',
        'محامي موثوق ومحترف',
        'أفضل محامي تعاملت معه',
        'خدمة ممتازة وتوصيات قيمة',
        'محترف في مجاله',
        'رائع جداً ومتجاوب',
    ],
    4 => [
        'محامي جيد ومحترف',
        'خدمة جيدة',
        'أداء جيد',
        'محترف',
    ],
    3 => [
        'مقبول',
        'أداء متوسط',
    ],
    2 => [
        'أداء ضعيف',
    ],
    1 => [
        'أداء سيء',
    ],
];

$ratingComments = $comments[$ratingValue] ?? $comments[5];

echo "🔄 جاري المعالجة...\n\n";

foreach ($lawyers as $index => $lawyer) {
    $lawyerNumber = $index + 1;
    
    // التحقق من وجود تقييمات أدمن سابقة
    $existingRatings = Rating::where('lawyer_id', $lawyer->id)
        ->where('is_admin_created', true)
        ->count();

    if ($existingRatings > 0 && !$force) {
        echo "⏭️  [$lawyerNumber] تخطي المحامي: {$lawyer->name} (لديه تقييمات سابقة)\n";
        $skipped++;
        continue;
    }

    // إذا كان force مفعّل، احذف التقييمات الموجودة
    if ($force && $existingRatings > 0) {
        $deleted = Rating::where('lawyer_id', $lawyer->id)
            ->where('is_admin_created', true)
            ->delete();
        echo "🗑️  [$lawyerNumber] حذف {$deleted} تقييم سابق للمحامي: {$lawyer->name}\n";
    }

    // إنشاء تقييمات جديدة لهذا المحامي
    for ($i = 0; $i < $countPerLawyer; $i++) {
        $comment = $ratingComments[array_rand($ratingComments)];
        
        Rating::create([
            'lawyer_id' => $lawyer->id,
            'user_id' => null,
            'rating' => $ratingValue,
            'comment' => $comment,
            'is_admin_created' => true,
            'created_by_admin_id' => $admin->id,
            'status' => true,
        ]);
        
        $totalRatingsCreated++;
    }

    echo "✅ [$lawyerNumber] تم إضافة {$countPerLawyer} تقييم للمحامي: {$lawyer->name}\n";
}

echo "\n";
echo "════════════════════════════════════════════════\n";
echo "✅ تم الانتهاء بنجاح!\n\n";
echo "📊 ملخص النتائج:\n";
echo "   • المحاميين المعالجين: {$lawyers->count()}\n";
echo "   • التقييمات الجديدة: {$totalRatingsCreated}\n";
echo "   • المحاميين المتخطيين: {$skipped}\n";
echo "   • قيمة التقييم: {$ratingValue} / 5\n";
echo "════════════════════════════════════════════════\n";

