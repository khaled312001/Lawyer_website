<?php
// Simple test script - no Laravel bootstrap needed
// DELETE AFTER USE

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo '<html><head><meta charset="utf-8"><style>
body{font-family:monospace;padding:20px;background:#1a1a1a;color:#eee;}
.ok{color:#4caf50;font-weight:bold;}
.fail{color:#f44336;font-weight:bold;}
.info{color:#90caf9;}
h3{color:#fff;border-bottom:1px solid #444;padding-bottom:5px;}
</style></head><body><h2 style="color:#fff;">Lawyer Form - Full Test</h2>';

// ===== Read .env =====
$envFile = __DIR__ . '/../.env';
$env = [];
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (strpos(trim($line), '#') === 0 || strpos($line, '=') === false) continue;
        [$k, $v] = explode('=', $line, 2);
        $env[trim($k)] = trim(trim($v), '"\'');
    }
}

$dbHost = $env['DB_HOST'] ?? '127.0.0.1';
$dbPort = $env['DB_PORT'] ?? '3306';
$dbName = $env['DB_DATABASE'] ?? '';
$dbUser = $env['DB_USERNAME'] ?? '';
$dbPass = $env['DB_PASSWORD'] ?? '';
$mailHost = $env['MAIL_HOST'] ?? 'smtp.hostinger.com';
$mailPort = $env['MAIL_PORT'] ?? '465';
$mailUser = $env['MAIL_USERNAME'] ?? '';
$mailPass = $env['MAIL_PASSWORD'] ?? '';
$mailFrom = $env['MAIL_FROM_ADDRESS'] ?? '';

echo '<h3>Config</h3>';
echo "DB: {$dbHost}:{$dbPort} / {$dbName} / {$dbUser}<br>";
echo "Mail: {$mailHost}:{$mailPort} / {$mailUser} / pass-length:" . strlen($mailPass) . "<br>";

// ===== STEP 1: DB Test =====
echo '<h3>Step 1: Database</h3>';
try {
    $pdo = new PDO("mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5,
    ]);
    $count = $pdo->query("SELECT COUNT(*) FROM lawyer_join_requests")->fetchColumn();
    echo "<span class='ok'>✅ DB connected — {$count} records in lawyer_join_requests</span><br>";
    $dbOk = true;
} catch (\Exception $e) {
    echo "<span class='fail'>❌ DB Error: " . htmlspecialchars($e->getMessage()) . "</span><br>";
    $dbOk = false;
}

// ===== STEP 2: Save test record =====
echo '<h3>Step 2: Save to DB</h3>';
$cvPath = 'lawyer-cvs/test-cv-' . time() . '.pdf';
$appUrl = rtrim($env['APP_URL'] ?? 'https://amanlaw.ch', '/');
$cvUrl  = $appUrl . '/storage/' . $cvPath;

if ($dbOk) {
    try {
        $stmt = $pdo->prepare("INSERT INTO lawyer_join_requests
            (lawyer_name, lawyer_email, country_code, lawyer_phone, specialization, experience_years, lawyer_location, lawyer_bio, cv_path, status, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW(), NOW())");
        $stmt->execute(['اختبار', 'test@amanlaw.ch', '+963', '0991234567', 'قانون مدني', 5, 'دمشق', 'اختبار تجريبي', $cvPath]);
        echo "<span class='ok'>✅ Record saved — ID: " . $pdo->lastInsertId() . "</span><br>";
    } catch (\Exception $e) {
        echo "<span class='fail'>❌ Save Error: " . htmlspecialchars($e->getMessage()) . "</span><br>";
    }
} else {
    echo "<span class='fail'>⏭ Skipped (no DB)</span><br>";
}

// ===== STEP 3: Storage test =====
echo '<h3>Step 3: Storage</h3>';
$storagePath = __DIR__ . '/../storage/app/public/lawyer-cvs/';
if (!is_dir($storagePath)) {
    @mkdir($storagePath, 0775, true);
}
if (is_dir($storagePath)) {
    file_put_contents($storagePath . 'test-cv-dummy.pdf', '%PDF-1.4 Test');
    echo "<span class='ok'>✅ Storage writable: {$storagePath}</span><br>";
} else {
    echo "<span class='fail'>❌ Storage NOT writable: {$storagePath}</span><br>";
}

// Check symlink
$symlinkPath = __DIR__ . '/storage';
if (is_link($symlinkPath) || is_dir($symlinkPath)) {
    echo "<span class='ok'>✅ public/storage symlink exists</span><br>";
} else {
    echo "<span class='fail'>❌ public/storage symlink MISSING — run: php artisan storage:link</span><br>";
}

// ===== STEP 4: Send Email =====
echo '<h3>Step 4: Send Email via SMTP</h3>';

$subject  = 'TEST طلب انضمام محامي - ' . date('H:i:s');
$to       = 'info@amanlaw.ch';
$cvLink   = '<a href="' . $cvUrl . '" style="background:#0b2c64;color:#fff;padding:8px 16px;border-radius:6px;text-decoration:none;">⬇ تحميل السيرة الذاتية</a>';

$body = '<!DOCTYPE html><html dir="rtl" lang="ar"><head><meta charset="UTF-8"></head><body style="font-family:Tahoma;background:#f0f2f5;padding:20px;">';
$body .= '<div style="max-width:600px;margin:auto;background:#fff;border-radius:12px;overflow:hidden;">';
$body .= '<div style="background:linear-gradient(135deg,#0b2c64,#1a3d7a);padding:30px;text-align:center;">';
$body .= '<h1 style="color:#fff;margin:0;">طلب انضمام محامي جديد</h1>';
$body .= '<p style="color:rgba(255,255,255,0.8);margin:5px 0 0;">Aman Law | أمان لو</p></div>';
$body .= '<table width="100%" style="border-collapse:collapse;padding:20px;" cellpadding="12">';
$body .= '<tr style="background:#f9f9f9;"><td style="color:#0b2c64;font-weight:bold;width:40%;">الاسم الكامل</td><td>اختبار تجريبي</td></tr>';
$body .= '<tr><td style="color:#0b2c64;font-weight:bold;">البريد الإلكتروني</td><td>test@amanlaw.ch</td></tr>';
$body .= '<tr style="background:#f9f9f9;"><td style="color:#0b2c64;font-weight:bold;">رقم الهاتف</td><td dir="ltr">+963 0991234567</td></tr>';
$body .= '<tr><td style="color:#0b2c64;font-weight:bold;">التخصص القانوني</td><td>قانون مدني</td></tr>';
$body .= '<tr style="background:#f9f9f9;"><td style="color:#0b2c64;font-weight:bold;">سنوات الخبرة</td><td>5 سنوات</td></tr>';
$body .= '<tr><td style="color:#0b2c64;font-weight:bold;">الموقع</td><td>دمشق، سوريا</td></tr>';
$body .= '<tr style="background:#f9f9f9;"><td style="color:#0b2c64;font-weight:bold;">السيرة الذاتية</td><td>' . $cvLink . '</td></tr>';
$body .= '</table>';
$body .= '<div style="padding:15px;text-align:center;background:#f7f8fa;margin:15px;border-radius:8px;">';
$body .= '<p style="color:#444;">نبذة: اختبار تجريبي للتحقق من عمل النظام - ' . date('Y-m-d H:i:s') . '</p></div>';
$body .= '<div style="background:#0a1f3f;padding:15px;text-align:center;">';
$body .= '<p style="color:rgba(255,255,255,0.5);margin:0;font-size:11px;">© ' . date('Y') . ' Aman Law | أمان لو</p></div></div></body></html>';

// Send via SMTP directly
$context = stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
$smtp = @stream_socket_client("ssl://{$mailHost}:{$mailPort}", $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $context);

if (!$smtp) {
    echo "<span class='fail'>❌ Cannot connect to SMTP: {$errno} {$errstr}</span><br>";
} else {
    fgets($smtp, 512); // banner
    fwrite($smtp, "EHLO amanlaw.ch\r\n");
    while ($l = fgets($smtp, 512)) { if ($l[3] == ' ') break; }

    fwrite($smtp, "AUTH LOGIN\r\n");
    fgets($smtp, 512);
    fwrite($smtp, base64_encode($mailUser) . "\r\n");
    fgets($smtp, 512);
    fwrite($smtp, base64_encode($mailPass) . "\r\n");
    $authResp = fgets($smtp, 512);
    $authCode = (int)substr($authResp, 0, 3);

    echo "<span class='info'>AUTH response: " . htmlspecialchars(trim($authResp)) . "</span><br>";

    if ($authCode === 235) {
        echo "<span class='ok'>✅ Auth OK</span><br>";

        fwrite($smtp, "MAIL FROM:<{$mailFrom}>\r\n"); fgets($smtp, 512);
        fwrite($smtp, "RCPT TO:<{$to}>\r\n"); fgets($smtp, 512);
        fwrite($smtp, "DATA\r\n"); fgets($smtp, 512);

        $boundary = md5(time());
        $headers  = "From: Aman Law <{$mailFrom}>\r\n";
        $headers .= "To: {$to}\r\n";
        $headers .= "Subject: =?UTF-8?B?" . base64_encode($subject) . "?=\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "Content-Transfer-Encoding: base64\r\n";

        fwrite($smtp, $headers . "\r\n" . chunk_split(base64_encode($body)) . "\r\n.\r\n");
        $sendResp = fgets($smtp, 512);
        $sendCode = (int)substr($sendResp, 0, 3);

        if ($sendCode === 250) {
            echo "<span class='ok'>✅ Email sent to {$to}!</span><br>";
        } else {
            echo "<span class='fail'>❌ Send failed: " . htmlspecialchars(trim($sendResp)) . "</span><br>";
        }
    } else {
        echo "<span class='fail'>❌ Auth FAILED — Wrong password!</span><br>";
    }
    fwrite($smtp, "QUIT\r\n");
    fclose($smtp);
}

echo '<br><hr><small style="color:#f44336;">⚠️ DELETE: public/test-lawyer-form.php</small>';
echo '</body></html>';
