<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== قائمة المحامين ===\n\n";

$lawyers = DB::table('lawyers')
    ->select('id', 'name', 'years_of_experience', 'department_id', 'location_id')
    ->orderBy('id', 'desc')
    ->limit(10)
    ->get();

foreach ($lawyers as $l) {
    echo "ID: {$l->id} - {$l->name} - Experience: {$l->years_of_experience}\n";
    
    // Get designations
    $trans = DB::table('lawyer_translations')
        ->where('lawyer_id', $l->id)
        ->where('lang_code', 'ar')
        ->select('designations')
        ->first();
    
    echo "  Designations: " . ($trans->designations ?? 'غير محدد') . "\n";
    
    // Get department
    if ($l->department_id) {
        $dept = DB::table('department_translations')
            ->where('department_id', $l->department_id)
            ->where('lang_code', 'ar')
            ->select('name')
            ->first();
        echo "  Department: " . ($dept->name ?? 'غير محدد') . "\n";
    }
    
    // Get location
    if ($l->location_id) {
        $loc = DB::table('location_translations')
            ->where('location_id', $l->location_id)
            ->where('lang_code', 'ar')
            ->select('name')
            ->first();
        echo "  Location: " . ($loc->name ?? 'غير محدد') . "\n";
    }
    
    echo "\n";
}
