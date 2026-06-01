<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$questions = \App\Models\Question::all();
foreach($questions as $q) {
    echo "ID: " . $q->id . " | Quiz: " . $q->quiz_id . " | Text: " . $q->question_text . "\n";
}
