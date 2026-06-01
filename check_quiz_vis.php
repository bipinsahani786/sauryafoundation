<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$student1 = App\Models\User::where('role', 'student')->where('class_id', 1)->first();
$student2 = App\Models\User::where('role', 'student')->where('class_id', 2)->first();
$student3 = App\Models\User::where('role', 'student')->where('class_id', 3)->first();

function checkQuizzes($user) {
    if (!$user) return;
    echo "Student ID: " . $user->id . ", Class ID: " . $user->class_id . "\n";
    $quizzes = App\Models\Quiz::where('status', 'published')
        ->where(function($q) use ($user) {
            $q->where(function($classQuery) use ($user) {
                $classQuery->whereHas('studentClasses', function($sq) use ($user) {
                    $sq->where('student_classes.id', $user->class_id);
                })->orWhereDoesntHave('studentClasses');
            })->where(function($teacherQuery) use ($user) {
                $teacherQuery->where('is_global', true)
                             ->orWhere('teacher_id', $user->teacher_id)
                             ->orWhereHas('teacher', function($t) {
                                 $t->whereIn('role', ['admin', 'superadmin']);
                             });
            });
        })->get();
    echo "Visible Quizzes: " . $quizzes->pluck('id')->implode(',') . "\n\n";
}

checkQuizzes($student1);
checkQuizzes($student2);
checkQuizzes($student3);
