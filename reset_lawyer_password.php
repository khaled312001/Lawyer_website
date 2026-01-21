<?php

/**
 * Script to reset lawyer password
 * 
 * Usage: php reset_lawyer_password.php <email> <new_password>
 * Example: php reset_lawyer_password.php mohammad.ali.albalkhi@amanlaw.ch MAB1997
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Get email and password from command line or use defaults
$email = $argv[1] ?? 'mohammad.ali.albalkhi@amanlaw.ch';
$newPassword = $argv[2] ?? 'MAB1997';

echo "=== إعادة تعيين كلمة مرور المحامي ===\n\n";
echo "الإيميل: {$email}\n";
echo "كلمة المرور الجديدة: {$newPassword}\n\n";

// Find lawyer
$lawyer = Lawyer::where('email', $email)->first();

if (!$lawyer) {
    echo "❌ المحامي غير موجود\n";
    exit(1);
}

echo "✓ المحامي موجود\n";
echo "  - ID: {$lawyer->id}\n";
echo "  - الاسم: {$lawyer->name}\n\n";

// Hash the new password
$hashedPassword = Hash::make($newPassword);

// Update password directly in database (bypassing the model cast)
DB::table('lawyers')
    ->where('id', $lawyer->id)
    ->update(['password' => $hashedPassword]);

echo "✓ تم تحديث كلمة المرور\n\n";

// Verify the password
$lawyer->refresh();
$rawPassword = $lawyer->getRawOriginal('password');
$passwordValid = Hash::check($newPassword, $rawPassword);

if ($passwordValid) {
    echo "✅ تم التحقق من كلمة المرور - صحيحة\n";
} else {
    echo "❌ خطأ في التحقق من كلمة المرور\n";
}

echo "\n=== ملخص ===\n";
echo "الإيميل: {$email}\n";
echo "كلمة المرور الجديدة: {$newPassword}\n";
echo "الحالة: " . ($lawyer->status == 1 ? 'نشط' : 'غير نشط') . "\n";
echo "التحقق من الإيميل: " . ($lawyer->email_verified_at ? 'نعم' : 'لا') . "\n";
