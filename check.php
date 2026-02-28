<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$blogs = Modules\Blog\app\Models\Blog::with('translation')->get(); 
foreach($blogs as $b) { 
    echo $b->id . ' | ' . ($b->translation ? $b->translation->title : 'No Translation') . ' | Image: ' . $b->image . " | Feature: " . $b->is_feature . "\n";
}
