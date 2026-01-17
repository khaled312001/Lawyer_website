<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== قائمة جميع الأقسام ===\n\n";

$departments = DB::table('departments')
    ->join('department_translations', 'departments.id', '=', 'department_translations.department_id')
    ->where('department_translations.lang_code', 'ar')
    ->select('departments.id', 'departments.slug', 'department_translations.name')
    ->orderBy('departments.id')
    ->get();

echo "إجمالي الأقسام: " . $departments->count() . "\n\n";

foreach ($departments as $dept) {
    echo "ID: {$dept->id} - {$dept->name}\n";
}

echo "\n✅ انتهى\n";
