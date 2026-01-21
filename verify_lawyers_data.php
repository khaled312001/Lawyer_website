<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== التحقق من بيانات المحاميين ===\n\n";

$lawyers = DB::table('lawyers')
    ->join('lawyer_translations', 'lawyers.id', '=', 'lawyer_translations.lawyer_id')
    ->where('lawyer_translations.lang_code', 'ar')
    ->select('lawyers.id', 'lawyers.name', 'lawyer_translations.about', 'lawyer_translations.educations', 'lawyer_translations.experience', 'lawyer_translations.qualifications', 'lawyer_translations.designations')
    ->orderBy('lawyers.id')
    ->get();

foreach ($lawyers as $lawyer) {
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "👤 المحامي: {$lawyer->name} (ID: {$lawyer->id})\n";
    echo "📋 الصفة: " . ($lawyer->designations ?? 'غير محدد') . "\n";
    echo "\n";
    
    echo "📝 نبذة عن المحامي:\n";
    echo ($lawyer->about ?? 'غير موجود') . "\n";
    echo "\n";
    
    echo "🎓 التعليم:\n";
    echo ($lawyer->educations ?? 'غير موجود') . "\n";
    echo "\n";
    
    echo "💼 الخبرة:\n";
    echo ($lawyer->experience ?? 'غير موجود') . "\n";
    echo "\n";
    
    echo "🏆 المؤهلات:\n";
    echo ($lawyer->qualifications ?? 'غير موجود') . "\n";
    echo "\n";
    
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
}

echo "✅ تم التحقق من " . $lawyers->count() . " محامي\n";
