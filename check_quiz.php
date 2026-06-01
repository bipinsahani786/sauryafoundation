<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$quizzes = App\Models\Quiz::all();

foreach($quizzes as $qz) {
    echo "Quiz: " . $qz->id . " | Title: " . $qz->title . " | Global: " . $qz->is_global . " | Classes: " . $qz->studentClasses->pluck('id')->implode(',') . "\n";
}
