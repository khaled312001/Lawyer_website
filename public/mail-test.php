<?php

// Simple mail test script - DELETE AFTER USE
// Access: https://amanlaw.ch/mail-test.php

$host       = 'smtp.hostinger.com';
$port       = 465;
$username   = 'info@amanlaw.ch';
$password   = getenv('MAIL_PASSWORD') ?: '';
$testTo     = $_GET['to'] ?? 'info@amanlaw.ch';
$encryption = 'ssl';

echo '<html><head><meta charset="utf-8"><style>body{font-family:monospace;padding:20px;} .ok{color:green;} .fail{color:red;} .info{color:#333;}</style></head><body>';
echo '<h2>Aman Law - Mail Config Test</h2>';

// Read .env manually
$envFile = __DIR__ . '/../.env';
$envVars = [];
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            [$key, $val] = explode('=', $line, 2);
            $envVars[trim($key)] = trim(trim($val), '"\'');
        }
    }
}

$password   = $envVars['MAIL_PASSWORD'] ?? '';
$username   = $envVars['MAIL_USERNAME'] ?? 'info@amanlaw.ch';
$fromName   = $envVars['MAIL_FROM_NAME'] ?? 'Aman Law';

echo '<h3>Config from .env:</h3>';
echo '<table border="1" cellpadding="6">';
echo '<tr><td>MAIL_HOST</td><td>' . htmlspecialchars($envVars['MAIL_HOST'] ?? '') . '</td></tr>';
echo '<tr><td>MAIL_PORT</td><td>' . htmlspecialchars($envVars['MAIL_PORT'] ?? '') . '</td></tr>';
echo '<tr><td>MAIL_USERNAME</td><td>' . htmlspecialchars($username) . '</td></tr>';
echo '<tr><td>MAIL_PASSWORD</td><td>' . str_repeat('*', strlen($password)) . ' (' . strlen($password) . ' chars)</td></tr>';
echo '<tr><td>MAIL_ENCRYPTION</td><td>' . htmlspecialchars($envVars['MAIL_ENCRYPTION'] ?? '') . '</td></tr>';
echo '</table>';

echo '<h3>Test 1: SMTP Connection</h3>';

// Test socket connection
$context = stream_context_create([
    'ssl' => [
        'verify_peer'       => false,
        'verify_peer_name'  => false,
    ]
]);

$socket = @stream_socket_client(
    "ssl://{$host}:{$port}",
    $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $context
);

if (!$socket) {
    echo "<span class='fail'>❌ Cannot connect to {$host}:{$port} - Error: $errno $errstr</span><br>";
} else {
    $response = fgets($socket, 512);
    echo "<span class='ok'>✅ Connected to {$host}:{$port}</span><br>";
    echo "<span class='info'>Server: " . htmlspecialchars($response) . "</span><br>";

    echo '<h3>Test 2: SMTP Auth</h3>';

    // EHLO
    fwrite($socket, "EHLO amanlaw.ch\r\n");
    $ehlo = '';
    while ($line = fgets($socket, 512)) {
        $ehlo .= $line;
        if (substr($line, 3, 1) == ' ') break;
    }
    echo "<span class='info'>EHLO response: OK</span><br>";

    // AUTH LOGIN
    fwrite($socket, "AUTH LOGIN\r\n");
    $authResp = fgets($socket, 512);
    echo "<span class='info'>AUTH: " . htmlspecialchars(trim($authResp)) . "</span><br>";

    // Username
    fwrite($socket, base64_encode($username) . "\r\n");
    $userResp = fgets($socket, 512);
    echo "<span class='info'>Username sent: " . htmlspecialchars(trim($userResp)) . "</span><br>";

    // Password
    fwrite($socket, base64_encode($password) . "\r\n");
    $passResp = fgets($socket, 512);
    $passCode = substr(trim($passResp), 0, 3);

    if ($passCode === '235') {
        echo "<span class='ok'>✅ AUTH SUCCESS! Password is correct.</span><br>";

        echo '<h3>Test 3: Send Test Email</h3>';
        fwrite($socket, "MAIL FROM:<{$username}>\r\n");
        $mfResp = fgets($socket, 512);

        fwrite($socket, "RCPT TO:<{$testTo}>\r\n");
        $rcptResp = fgets($socket, 512);

        fwrite($socket, "DATA\r\n");
        $dataResp = fgets($socket, 512);

        $body = "From: {$fromName} <{$username}>\r\n";
        $body .= "To: {$testTo}\r\n";
        $body .= "Subject: Test Mail from Aman Law\r\n";
        $body .= "Content-Type: text/plain; charset=utf-8\r\n\r\n";
        $body .= "This is a test email from amanlaw.ch - " . date('Y-m-d H:i:s') . "\r\n.\r\n";

        fwrite($socket, $body);
        $sendResp = fgets($socket, 512);
        $sendCode = substr(trim($sendResp), 0, 3);

        if ($sendCode === '250') {
            echo "<span class='ok'>✅ Email sent successfully to {$testTo}!</span><br>";
        } else {
            echo "<span class='fail'>❌ Send failed: " . htmlspecialchars($sendResp) . "</span><br>";
        }
    } else {
        echo "<span class='fail'>❌ AUTH FAILED: " . htmlspecialchars(trim($passResp)) . "</span><br>";
        echo "<span class='fail'>Password is WRONG. Please update MAIL_PASSWORD in .env</span><br>";
    }

    fwrite($socket, "QUIT\r\n");
    fclose($socket);
}

echo '<br><hr><small style="color:red;">⚠️ Delete this file after testing: public/mail-test.php</small>';
echo '</body></html>';
