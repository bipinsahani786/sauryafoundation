<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$quizzes = App\Models\Quiz::latest()->take(3)->get();
foreach ($quizzes as $qz) {
    echo 'Quiz ID: ' . $qz->id . ' | Title: ' . $qz->title . ' | Global: ' . $qz->is_global . ' | Status: ' . $qz->status . ' | Classes: ' . $qz->studentClasses->pluck('id')->implode(',') . "\n";
}
