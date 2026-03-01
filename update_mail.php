<?php
// Run this script from the command line: php update_mail.php
// Then delete it after running

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Modules\GlobalSetting\app\Models\Setting;
use Illuminate\Support\Facades\Cache;

$updates = [
    'mail_host' => 'smtp.hostinger.com',
    'mail_port' => '465',
    'mail_username' => 'info@amanlaw.ch',
    'mail_password' => 'support@Passord123support@Passord123',
    'mail_encryption' => 'ssl',
    'mail_sender_email' => 'info@amanlaw.ch',
    'mail_sender_name' => 'Aman Law',
    'contact_message_receiver_mail' => 'info@amanlaw.ch',
];

foreach ($updates as $key => $value) {
    Setting::where('key', $key)->update(['value' => $value]);
    echo "Updated: $key\n";
}

Cache::forget('setting');
echo "\nCache cleared. Mail settings updated successfully!\n";
