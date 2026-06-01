<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $quiz = App\Models\Quiz::latest()->first();
    echo "Creating question for quiz ID: " . $quiz->id . "\n";
    $question = $quiz->questions()->create([
        'question_text' => 'Test Question',
        'options' => ['A', 'B', 'C', 'D'],
        'correct_option' => 0,
        'marks' => 1,
    ]);
    echo "Created question ID: " . $question->id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
