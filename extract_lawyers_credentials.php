<?php

/**
 * Script to extract email and password (hashed) for all lawyers
 * 
 * Usage: php extract_lawyers_credentials.php
 */

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Modules\Lawyer\app\Models\Lawyer;
use Illuminate\Support\Facades\DB;

echo "=== استخراج بيانات تسجيل الدخول لجميع المحامين ===\n\n";

// Get all lawyers with raw password (bypassing the hashed cast)
$lawyers = DB::table('lawyers')
    ->select('id', 'name', 'email', 'password', 'phone', 'status', 'email_verified_at')
    ->orderBy('id')
    ->get();

if ($lawyers->isEmpty()) {
    echo "❌ لم يتم العثور على أي محامي في قاعدة البيانات.\n";
    exit(1);
}

echo "تم العثور على {$lawyers->count()} محامي:\n\n";

// Prepare data for output
$credentials = [];
$outputText = "=== بيانات تسجيل الدخول لجميع المحامين ===\n\n";
$outputText .= "إجمالي المحامين: {$lawyers->count()}\n";
$outputText .= "تاريخ الاستخراج: " . date('Y-m-d H:i:s') . "\n\n";
$outputText .= str_repeat("=", 80) . "\n\n";

foreach ($lawyers as $lawyer) {
    $statusText = $lawyer->status == 1 ? "نشط" : "غير نشط";
    $verifiedText = $lawyer->email_verified_at ? "✓ تم التحقق" : "✗ غير محقق";
    
    $outputText .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $outputText .= "ID: {$lawyer->id}\n";
    $outputText .= "الاسم: {$lawyer->name}\n";
    $outputText .= "📧 الإيميل: {$lawyer->email}\n";
    $outputText .= "🔑 كلمة المرور (مشفرة): {$lawyer->password}\n";
    $outputText .= "📱 الهاتف: {$lawyer->phone}\n";
    $outputText .= "الحالة: {$statusText}\n";
    $outputText .= "التحقق من الإيميل: {$verifiedText}\n";
    $outputText .= "\n";
    
    // Also store in array for JSON export
    $credentials[] = [
        'id' => $lawyer->id,
        'name' => $lawyer->name,
        'email' => $lawyer->email,
        'password_hash' => $lawyer->password,
        'phone' => $lawyer->phone,
        'status' => $lawyer->status == 1 ? 'active' : 'inactive',
        'email_verified' => $lawyer->email_verified_at ? true : false,
    ];
    
    // Display to console
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "ID: {$lawyer->id}\n";
    echo "الاسم: {$lawyer->name}\n";
    echo "📧 الإيميل: {$lawyer->email}\n";
    echo "🔑 كلمة المرور (مشفرة): {$lawyer->password}\n";
    echo "📱 الهاتف: {$lawyer->phone}\n";
    echo "الحالة: {$statusText}\n";
    echo "التحقق من الإيميل: {$verifiedText}\n";
    echo "\n";
}

$outputText .= str_repeat("=", 80) . "\n";
$outputText .= "\nملاحظة: كلمات المرور مخزنة بشكل مشفر (hashed) في قاعدة البيانات.\n";
$outputText .= "لا يمكن استرجاع كلمات المرور الأصلية من القيم المشفرة.\n";

// Save to text file
$textFileName = 'lawyers_credentials_' . date('Y-m-d_H-i-s') . '.txt';
file_put_contents($textFileName, $outputText);
echo "✓ تم حفظ البيانات في ملف نصي: {$textFileName}\n\n";

// Save to JSON file
$jsonFileName = 'lawyers_credentials_' . date('Y-m-d_H-i-s') . '.json';
file_put_contents($jsonFileName, json_encode($credentials, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✓ تم حفظ البيانات في ملف JSON: {$jsonFileName}\n\n";

// Save CSV file
$csvFileName = 'lawyers_credentials_' . date('Y-m-d_H-i-s') . '.csv';
$csvHandle = fopen($csvFileName, 'w');
// Add BOM for UTF-8 to support Arabic in Excel
fprintf($csvHandle, chr(0xEF).chr(0xBB).chr(0xBF));
// Headers
fputcsv($csvHandle, ['ID', 'الاسم', 'الإيميل', 'كلمة المرور (مشفرة)', 'الهاتف', 'الحالة', 'التحقق من الإيميل']);
// Data
foreach ($credentials as $cred) {
    fputcsv($csvHandle, [
        $cred['id'],
        $cred['name'],
        $cred['email'],
        $cred['password_hash'],
        $cred['phone'],
        $cred['status'],
        $cred['email_verified'] ? 'نعم' : 'لا'
    ]);
}
fclose($csvHandle);
echo "✓ تم حفظ البيانات في ملف CSV: {$csvFileName}\n\n";

echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "\n=== ملخص ===\n";
$activeCount = count(array_filter($credentials, fn($c) => $c['status'] === 'active'));
$verifiedCount = count(array_filter($credentials, fn($c) => $c['email_verified'] === true));

echo "إجمالي المحامين: " . count($credentials) . "\n";
echo "المحامين النشطين: {$activeCount}\n";
echo "المحامين المحققين: {$verifiedCount}\n";
echo "\n";

echo "✅ تم استخراج بيانات جميع المحامين بنجاح!\n";
echo "📁 الملفات المحفوظة:\n";
echo "   - {$textFileName}\n";
echo "   - {$jsonFileName}\n";
echo "   - {$csvFileName}\n";
