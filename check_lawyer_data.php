<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Modules\Lawyer\app\Models\Lawyer;

echo "=== التحقق من بيانات المحامي ID 63 ===\n\n";

$lawyer = Lawyer::with([
    'translation' => function ($query) {
        $query->select('lawyer_id', 'designations');
    },
    'department' => function ($query) {
        $query->select('id');
    },
    'department.translation' => function ($query) {
        $query->select('department_id', 'name');
    },
    'location' => function ($query) {
        $query->select('id');
    },
    'location.translation' => function ($query) {
        $query->select('location_id', 'name');
    },
])->find(63);

if ($lawyer) {
    echo "المحامي: {$lawyer->name}\n";
    echo "سنوات الخبرة: " . ($lawyer->years_of_experience ?? 'غير محدد') . "\n";
    echo "الصفة (designations): " . ($lawyer->designations ?? 'غير محدد') . "\n";
    echo "القسم: " . ($lawyer->department->name ?? 'غير محدد') . "\n";
    echo "الموقع: " . ($lawyer->location->name ?? 'غير محدد') . "\n";
    
    // Check translations directly
    echo "\n=== الترجمات من قاعدة البيانات ===\n";
    $translations = DB::table('lawyer_translations')
        ->where('lawyer_id', 63)
        ->get();
    
    foreach ($translations as $trans) {
        echo "اللغة: {$trans->lang_code}\n";
        echo "  الصفة: " . ($trans->designations ?? 'غير محدد') . "\n";
    }
    
    // Check department
    echo "\n=== القسم من قاعدة البيانات ===\n";
    $dept = DB::table('departments')
        ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
        ->where('departments.id', $lawyer->department_id)
        ->where('department_translations.lang_code', 'ar')
        ->select('department_translations.name')
        ->first();
    
    if ($dept) {
        echo "اسم القسم: {$dept->name}\n";
    }
    
    // Check location
    echo "\n=== الموقع من قاعدة البيانات ===\n";
    $loc = DB::table('locations')
        ->join('location_translations', 'locations.id', '=', 'location_translations.location_id')
        ->where('locations.id', $lawyer->location_id)
        ->where('location_translations.lang_code', 'ar')
        ->select('location_translations.name')
        ->first();
    
    if ($loc) {
        echo "اسم الموقع: {$loc->name}\n";
    }
} else {
    echo "المحامي غير موجود!\n";
}
