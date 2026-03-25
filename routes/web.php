<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\PlanController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Syndicate\SyndicateController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Teacher\CourseController;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/process', 'process')->name('process');
    Route::get('/returns', 'returns')->name('returns');
    Route::get('/privacy', 'privacy')->name('privacy');
    Route::get('/terms', 'terms')->name('terms');

    Route::prefix('sectors')->name('sectors.')->group(function () {
        Route::get('/marriage-halls', 'marriageHalls')->name('marriage-halls');
        Route::get('/education', 'education')->name('education');
        Route::get('/digital-coaching', 'coaching')->name('coaching');
    });

    Route::post('/apply', 'apply')->name('apply');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/applications', [AdminController::class, 'applications'])->name('applications');
    
    Route::resource('plans', PlanController::class);
    Route::post('/plans/{plan}/toggle-status', [PlanController::class, 'toggleStatus'])->name('plans.toggle-status');
    
    Route::get('/subscriptions', [AdminController::class, 'subscriptions'])->name('subscriptions');
    Route::post('/subscriptions/{subscription}/approve', [AdminController::class, 'approveSubscription'])->name('subscriptions.approve');
    Route::post('/subscriptions/{subscription}/reject', [AdminController::class, 'rejectSubscription'])->name('subscriptions.reject');

    Route::resource('users', UserController::class);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Quiz Approvals
    Route::get('/quizzes', [AdminController::class, 'quizzes'])->name('quizzes.index');
    Route::post('/quizzes/{quiz}/approve', [AdminController::class, 'approveQuiz'])->name('quizzes.approve');
    Route::post('/quizzes/{quiz}/reject', [AdminController::class, 'rejectQuiz'])->name('quizzes.reject');
});

// Shared Profile Route
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});

Route::middleware(['auth', 'syndicate'])->prefix('dashboard')->name('syndicate.')->group(function () {
    Route::get('/', [SyndicateController::class, 'index'])->name('dashboard');
    Route::get('/plans', [SyndicateController::class, 'plans'])->name('plans');
    Route::get('/plans/{plan}/join', [SyndicateController::class, 'joinForm'])->name('plans.join');
    Route::post('/plans/{plan}/join', [SyndicateController::class, 'submitJoin'])->name('plans.submit');
});

Route::middleware(['auth', 'teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'index'])->name('dashboard');
    Route::get('/students', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'students'])->name('students');
    Route::post('/students', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'addStudent'])->name('students.add');
    Route::get('/students/{student}/progress', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'studentProgress'])->name('students.progress');
    
    // Quizzes
    Route::resource('quizzes', App\Http\Controllers\Backend\Teacher\QuizController::class);
    Route::get('quizzes/{quiz}/results', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'results'])->name('quizzes.results');
    Route::post('quizzes/{quiz}/questions', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'addQuestion'])->name('quizzes.add-question');
    
    // Courses (LMS)
    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/subjects', [CourseController::class, 'addSubject'])->name('courses.add-subject');
    Route::post('subjects/{subject}/topics', [CourseController::class, 'addTopic'])->name('subjects.add-topic');
    Route::post('topics/{topic}/contents', [CourseController::class, 'addContent'])->name('topics.add-content');
});

Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Backend\Student\StudentController::class, 'index'])->name('dashboard');
    
    // Exams & Security
    Route::get('/exams', [App\Http\Controllers\Backend\Student\StudentController::class, 'exams'])->name('exams');
    Route::get('/exams/{quiz}', [App\Http\Controllers\Backend\Student\StudentController::class, 'showExam'])->name('exams.show');
    Route::post('/exams/{quiz}/start', [App\Http\Controllers\Backend\Student\StudentController::class, 'startExam'])->name('exams.start');
    Route::get('/exams/{quiz}/take', [App\Http\Controllers\Backend\Student\StudentController::class, 'takeExam'])->name('exams.take');
    Route::post('/exams/{quiz}/submit', [App\Http\Controllers\Backend\Student\StudentController::class, 'submitExam'])->name('exams.submit');
    Route::post('/exams/{quiz}/report-breach', [App\Http\Controllers\Backend\Student\StudentController::class, 'reportBreach'])->name('exams.report-breach');
    Route::get('/results/{attempt}', [App\Http\Controllers\Backend\Student\StudentController::class, 'showResult'])->name('results.show');
    
    // LMS Courses
    Route::get('/courses', [App\Http\Controllers\Backend\Student\StudentController::class, 'courses'])->name('courses');
    Route::get('/courses/{course}', [App\Http\Controllers\Backend\Student\StudentController::class, 'showCourse'])->name('courses.show');
    Route::post('/courses/{course}/enroll', [App\Http\Controllers\Backend\Student\StudentController::class, 'enroll'])->name('courses.enroll');
    Route::post('/contents/{content}/complete', [App\Http\Controllers\Backend\Student\StudentController::class, 'completeContent'])->name('contents.complete');
});
