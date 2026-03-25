<?php
// Test script - simulates lawyer join form submission
// Access: https://amanlaw.ch/test-lawyer-form.php
// DELETE AFTER USE

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\LawyerJoinRequest;

echo '<html><head><meta charset="utf-8"><style>
body{font-family:monospace;padding:20px;background:#1a1a1a;color:#eee;}
.ok{color:#4caf50;font-weight:bold;}
.fail{color:#f44336;font-weight:bold;}
.info{color:#90caf9;}
.warn{color:#ffb74d;}
pre{background:#222;padding:10px;border-radius:5px;overflow:auto;}
</style></head><body>';
echo '<h2 style="color:#fff;">🔧 Lawyer Form - Full Test</h2>';

$steps = [];

// ===== STEP 1: DB Connection =====
echo '<h3 class="info">Step 1: Database</h3>';
try {
    $count = LawyerJoinRequest::count();
    echo "<span class='ok'>✅ DB connected - {$count} existing requests</span><br>";
    $steps['db'] = true;
} catch (\Exception $e) {
    echo "<span class='fail'>❌ DB Error: " . htmlspecialchars($e->getMessage()) . "</span><br>";
    $steps['db'] = false;
}

// ===== STEP 2: Create fake CV file =====
echo '<h3 class="info">Step 2: File Storage</h3>';
try {
    // Create a small fake PDF content
    $fakePdfContent = "%PDF-1.4 Test CV - Aman Law Test " . date('Y-m-d H:i:s');
    $cvPath = 'lawyer-cvs/test-cv-' . time() . '.pdf';
    Storage::disk('public')->put($cvPath, $fakePdfContent);
    $cvUrl = url('storage/' . $cvPath);
    echo "<span class='ok'>✅ CV file created at: {$cvPath}</span><br>";
    echo "<span class='info'>URL: <a href='{$cvUrl}' target='_blank' style='color:#90caf9;'>{$cvUrl}</a></span><br>";
    $steps['file'] = true;
} catch (\Exception $e) {
    echo "<span class='fail'>❌ File Error: " . htmlspecialchars($e->getMessage()) . "</span><br>";
    $steps['file'] = false;
    $cvPath = null;
    $cvUrl = null;
}

// ===== STEP 3: Save to DB =====
echo '<h3 class="info">Step 3: Save to Database</h3>';
try {
    $joinRequest = LawyerJoinRequest::create([
        'lawyer_name'      => 'اختبار تجريبي',
        'lawyer_email'     => 'test@amanlaw.ch',
        'country_code'     => '+963',
        'lawyer_phone'     => '0991234567',
        'specialization'   => 'قانون مدني',
        'experience_years' => 5,
        'lawyer_location'  => 'دمشق، سوريا',
        'lawyer_bio'       => 'هذا اختبار تجريبي للتحقق من عمل النظام.',
        'cv_path'          => $cvPath,
        'status'           => 'pending',
    ]);
    echo "<span class='ok'>✅ Saved to DB - ID: {$joinRequest->id}</span><br>";
    $steps['save'] = true;
} catch (\Exception $e) {
    echo "<span class='fail'>❌ DB Save Error: " . htmlspecialchars($e->getMessage()) . "</span><br>";
    $steps['save'] = false;
}

// ===== STEP 4: Build Email =====
echo '<h3 class="info">Step 4: Build Email HTML</h3>';

$cvLink = $cvUrl
    ? '<a href="' . $cvUrl . '" style="background:#0b2c64;color:#fff;padding:8px 16px;border-radius:6px;text-decoration:none;">⬇ تحميل السيرة الذاتية</a>'
    : '—';

$emailHtml = '<!DOCTYPE html><html dir="rtl" lang="ar"><head><meta charset="UTF-8"></head><body style="margin:0;padding:0;background:#f0f2f5;font-family:Tahoma,Arial,sans-serif;">';
$emailHtml .= '<table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center"><table width="620" cellpadding="0" cellspacing="0">';
$emailHtml .= '<tr><td style="background:linear-gradient(135deg,#0b2c64,#1a3d7a);padding:35px 30px;border-radius:16px 16px 0 0;text-align:center;">';
$emailHtml .= '<h1 style="color:#fff;margin:0;">طلب انضمام محامي جديد</h1>';
$emailHtml .= '<p style="color:rgba(255,255,255,0.85);margin:0;">Aman Law | أمان لو</p></td></tr>';
$emailHtml .= '<tr><td style="background:#fff;padding:20px 30px;">';
$emailHtml .= '<table width="100%" style="border:1px solid #e8e8e8;border-radius:10px;">';
$emailHtml .= '<tr><td style="padding:12px 18px;color:#0b2c64;font-weight:bold;">الاسم</td><td style="padding:12px 18px;">اختبار تجريبي</td></tr>';
$emailHtml .= '<tr style="background:#f9f9f9;"><td style="padding:12px 18px;color:#0b2c64;font-weight:bold;">البريد</td><td style="padding:12px 18px;">test@amanlaw.ch</td></tr>';
$emailHtml .= '<tr><td style="padding:12px 18px;color:#0b2c64;font-weight:bold;">الهاتف</td><td style="padding:12px 18px;" dir="ltr">+963 0991234567</td></tr>';
$emailHtml .= '<tr style="background:#f9f9f9;"><td style="padding:12px 18px;color:#0b2c64;font-weight:bold;">التخصص</td><td style="padding:12px 18px;">قانون مدني</td></tr>';
$emailHtml .= '<tr><td style="padding:12px 18px;color:#0b2c64;font-weight:bold;">الخبرة</td><td style="padding:12px 18px;">5 سنوات</td></tr>';
$emailHtml .= '<tr style="background:#f9f9f9;"><td style="padding:12px 18px;color:#0b2c64;font-weight:bold;">السيرة الذاتية</td><td style="padding:12px 18px;">' . $cvLink . '</td></tr>';
$emailHtml .= '</table></td></tr>';
$emailHtml .= '<tr><td style="background:#0a1f3f;padding:15px;text-align:center;border-radius:0 0 16px 16px;"><p style="color:rgba(255,255,255,0.5);margin:0;font-size:11px;">TEST - ' . date('Y-m-d H:i:s') . '</p></td></tr>';
$emailHtml .= '</table></td></tr></table></body></html>';

echo "<span class='ok'>✅ Email HTML built (" . strlen($emailHtml) . " chars)</span><br>";

// ===== STEP 5: Send Email =====
echo '<h3 class="info">Step 5: Send Email to info@amanlaw.ch</h3>';

$receiverEmail = 'info@amanlaw.ch';
$subject = 'TEST - طلب انضمام محامي - اختبار تجريبي ' . date('H:i:s');

echo "<span class='info'>Sending to: {$receiverEmail}</span><br>";
echo "<span class='info'>Mail host: " . config('mail.mailers.smtp.host') . "</span><br>";
echo "<span class='info'>Mail username: " . config('mail.mailers.smtp.username') . "</span><br>";
echo "<span class='info'>Mail password length: " . strlen(config('mail.mailers.smtp.password')) . " chars</span><br>";

try {
    Mail::html($emailHtml, function ($msg) use ($receiverEmail, $subject) {
        $msg->to($receiverEmail)
            ->subject($subject)
            ->from(
                config('mail.from.address', 'info@amanlaw.ch'),
                config('mail.from.name', 'Aman Law')
            );
    });
    echo "<span class='ok'>✅ Email sent successfully!</span><br>";
    $steps['mail'] = true;
} catch (\Exception $e) {
    echo "<span class='fail'>❌ Mail Error: " . htmlspecialchars($e->getMessage()) . "</span><br>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    $steps['mail'] = false;
}

// ===== SUMMARY =====
echo '<h3 class="info">Summary</h3>';
echo '<table border="1" cellpadding="8" style="border-collapse:collapse;">';
foreach (['db' => 'Database', 'file' => 'File Storage', 'save' => 'Save Record', 'mail' => 'Send Email'] as $key => $label) {
    $status = isset($steps[$key]) ? ($steps[$key] ? "<span class='ok'>✅ OK</span>" : "<span class='fail'>❌ FAIL</span>") : "<span class='warn'>⚠️ SKIP</span>";
    echo "<tr><td style='padding:8px 16px;'>{$label}</td><td>{$status}</td></tr>";
}
echo '</table>';

echo '<br><hr><small style="color:#f44336;">⚠️ DELETE THIS FILE: public/test-lawyer-form.php</small>';
echo '</body></html>';
