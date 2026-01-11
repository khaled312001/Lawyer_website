<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$lawyers = \Modules\Lawyer\app\Models\Lawyer::all();

$lawyerImages = [
    'James Anderson' => 'lawyers/lawyer-1.jpg',
    'Sarah Mitchell' => 'lawyers/lawyer-2.jpg',
    'Robert Thompson' => 'lawyers/lawyer-3.jpg',
    'Emily Johnson' => 'lawyers/lawyer-4.jpg',
    'Michael Williams' => 'lawyers/lawyer-5.jpg',
    'David Brown' => 'lawyers/lawyer-6.jpg',
    'Jessica Davis' => 'lawyers/lawyer-7.jpg',
    'Christopher Wilson' => 'lawyers/lawyer-8.jpg',
    'Amanda Taylor' => 'lawyers/lawyer-9.jpg',
    'Daniel Martinez' => 'lawyers/lawyer-10.jpg',
];

foreach ($lawyers as $lawyer) {
    if (isset($lawyerImages[$lawyer->name])) {
        $lawyer->update(['image' => $lawyerImages[$lawyer->name]]);
        echo "Updated {$lawyer->name} with image {$lawyerImages[$lawyer->name]}\n";
    }
}

echo "Done!\n";
