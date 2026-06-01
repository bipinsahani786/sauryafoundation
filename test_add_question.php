<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = \Illuminate\Http\Request::create('/admin/quizzes/8/questions', 'POST', [
    'question_text' => 'Simulated Request Question',
    'option_0' => 'A',
    'option_1' => 'B',
    'option_2' => 'C',
    'option_3' => 'D',
    'correct_option' => 1,
    'marks' => 2,
    '_token' => csrf_token(),
]);

// Since we are not authenticated, we'll bypass middleware by resolving the controller directly.
$controller = new \App\Http\Controllers\Backend\Admin\QuizController();
$quiz = \App\Models\Quiz::find(8);

try {
    $response = $controller->addQuestion($request, $quiz);
    echo "Response class: " . get_class($response) . "\n";
    if ($response instanceof \Illuminate\Http\RedirectResponse) {
        echo "Redirected to: " . $response->getTargetUrl() . "\n";
        echo "Session success: " . session('success') . "\n";
    }
} catch (\Illuminate\Validation\ValidationException $e) {
    echo "Validation failed:\n";
    print_r($e->errors());
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
