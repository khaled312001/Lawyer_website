<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Modules\Service\app\Models\Service;

$services = Service::with(['translations' => function($q) {
    $q->where('lang_code', 'ar');
}])->active()->get();

echo "الخدمات الموجودة:\n";
echo "==================\n\n";

foreach($services as $s) {
    $t = $s->translations->first();
    echo ($t ? $t->title : 'N/A') . "\n";
}
