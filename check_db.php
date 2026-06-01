<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$q = new \App\Models\Question();
echo json_encode(\Illuminate\Support\Facades\Schema::getColumnListing($q->getTable()));
echo "\n";
echo json_encode(\DB::table('questions')->get()->take(2));
