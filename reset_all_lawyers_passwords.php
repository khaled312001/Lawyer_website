<?php

/**
 * Script to reset all lawyers passwords to their original values
 * 
 * Usage: php reset_all_lawyers_passwords.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

echo "=== إعادة تعيين كلمات مرور جميع المحامين ===\n\n";

// List of lawyers with their passwords
$lawyersData = [
    [
        'email' => 'mohammad.khawaldeh@amanlaw.ch',
        'password' => 'MKH1967',
        'name' => 'محمد خوالدة'
    ],
    [
        'email' => 'mohammad.ali.albalkhi@amanlaw.ch',
        'password' => 'MAB1997',
        'name' => 'محمد علي البلخي'
    ],
    [
        'email' => 'mahmoud.mashileh@amanlaw.ch',
        'password' => 'MMS1996',
        'name' => 'محمود المرشد الشالح'
    ],
    [
        'email' => 'ziad.alzoubi@amanlaw.ch',
        'password' => 'ZZA1998',
        'name' => 'زياد الزعبي'
    ],
    [
        'email' => 'mohammad.basem.aljelda@amanlaw.ch',
        'password' => 'MBG2021',
        'name' => 'محمد باسم الجلدة'
    ],
    [
        'email' => 'ghazala.alashqar@amanlaw.ch',
        'password' => 'GAA2009',
        'name' => 'غزالة الأشقر'
    ],
    [
        'email' => 'bashar.mohammad.khawaldeh@amanlaw.ch',
        'password' => 'BMK2023',
        'name' => 'بشار محمد الخوالدة'
    ],
];

$successCount = 0;
$failedCount = 0;

foreach ($lawyersData as $lawyerData) {
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "المحامي: {$lawyerData['name']}\n";
    echo "الإيميل: {$lawyerData['email']}\n";
    echo "كلمة المرور: {$lawyerData['password']}\n";
    
    // Find lawyer
    $lawyer = Lawyer::where('email', $lawyerData['email'])->first();
    
    if (!$lawyer) {
        echo "❌ المحامي غير موجود\n\n";
        $failedCount++;
        continue;
    }
    
    echo "  - ID: {$lawyer->id}\n";
    
    // Hash the password
    $hashedPassword = Hash::make($lawyerData['password']);
    
    // Update password directly in database
    try {
        DB::table('lawyers')
            ->where('id', $lawyer->id)
            ->update(['password' => $hashedPassword]);
        
        // Verify the password
        $lawyer->refresh();
        $rawPassword = $lawyer->getRawOriginal('password');
        $passwordValid = Hash::check($lawyerData['password'], $rawPassword);
        
        if ($passwordValid) {
            echo "  ✅ تم تحديث كلمة المرور بنجاح\n";
            $successCount++;
        } else {
            echo "  ⚠ تم التحديث لكن التحقق فشل\n";
            $failedCount++;
        }
    } catch (\Exception $e) {
        echo "  ❌ خطأ في التحديث: " . $e->getMessage() . "\n";
        $failedCount++;
    }
    
    echo "\n";
}

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "\n=== ملخص ===\n";
echo "إجمالي المحامين: " . count($lawyersData) . "\n";
echo "نجح: {$successCount}\n";
echo "فشل: {$failedCount}\n\n";

if ($successCount > 0) {
    echo "✅ تم إعادة تعيين كلمات المرور بنجاح!\n";
    echo "يمكنك الآن تسجيل الدخول باستخدام البيانات المذكورة أعلاه.\n";
} else {
    echo "❌ فشل إعادة تعيين كلمات المرور.\n";
}
