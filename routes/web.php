<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\PlanController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\BannerController;
use App\Http\Controllers\Backend\Admin\HomeSectorController;
use App\Http\Controllers\Backend\Admin\TestimonialController;
use App\Http\Controllers\Backend\Admin\IndustryExpertController;
use App\Http\Controllers\Backend\SalesAgent\SalesAgentController;
use App\Http\Controllers\Backend\Syndicate\SyndicateController;
use App\Http\Controllers\Backend\ProfileController;

// Temporary route for maintenance and storage link on shared hosting
// Route::get('/maintenance', function () {
//     try {
//         // Clear all cache
//         \Illuminate\Support\Facades\Artisan::call('optimize:clear');

//         // Manual storage link (if not already exists)
//         $target = storage_path('app/public');
//         $link = public_path('storage');

//         $linkStatus = "Storage link: ";
//         if (!file_exists($link)) {
//             symlink($target, $link);
//             $linkStatus .= "Successfully created!";
//         } else {
//             $linkStatus .= "Already exists.";
//         }

//         return "<h3>Platform Maintenance Success</h3>
//                 <p>Caches cleared successfully.</p>
//                 <p>{$linkStatus}</p>
//                 <br><br>
//                 <small>Now you can delete this route from web.php for security.</small>";
//     } catch (\Exception $e) {
//         return "Maintenance error: " . $e->getMessage();
//     }
// });
use App\Http\Controllers\Backend\Teacher\CourseController;
use App\Http\Controllers\Backend\Admin\SettingController;

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
        Route::get('/{slug}', 'sectorDetail')->name('detail');
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

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/stop-impersonating', [UserController::class, 'stopImpersonating'])->name('admin.users.stop-impersonating');
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
    Route::post('/users/{user}/impersonate', [UserController::class, 'impersonate'])->name('users.impersonate');

    // Website Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Payouts & KYC Management
    Route::get('/payouts', [AdminController::class, 'payouts'])->name('payouts.index');
    Route::post('/kyc/{user}/verify', [AdminController::class, 'verifyKyc'])->name('kyc.verify');
    Route::post('/payouts/{payout}/approve', [AdminController::class, 'approvePayout'])->name('payout.approve');

    // Dynamic Classes Management
    Route::resource('student-classes', \App\Http\Controllers\Backend\Admin\StudentClassController::class);
    Route::post('/student-classes/{student_class}/toggle-status', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'toggleStatus'])->name('student-classes.toggle-status');

    // Home Banners
    Route::resource('banners', BannerController::class);
    Route::post('/banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status');

    // Home Sectors
    Route::resource('home-sectors', HomeSectorController::class);
    Route::post('/home-sectors/{home_sector}/toggle-status', [HomeSectorController::class, 'toggleStatus'])->name('home-sectors.toggle-status');

    // Quiz Approvals
    Route::get('/quiz-approvals', [AdminController::class, 'quizzes'])->name('quiz-approvals');
    Route::post('/quiz-approvals/{quiz}/approve', [AdminController::class, 'approveQuiz'])->name('quiz-approvals.approve');
    Route::post('/quiz-approvals/{quiz}/reject', [AdminController::class, 'rejectQuiz'])->name('quiz-approvals.reject');

    // Admin Quizzes (Manage Exams)
    Route::resource('quizzes', \App\Http\Controllers\Backend\Admin\QuizController::class);
    Route::get('/quizzes/{quiz}/results', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'results'])->name('quizzes.results');
    Route::get('/quizzes/sample-csv', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'downloadSampleCSV'])->name('quizzes.sample-csv');
    Route::post('/quizzes/{quiz}/questions', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'addQuestion'])->name('quizzes.add-question');
    Route::post('/quizzes/{quiz}/bulk-questions', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'addBulkQuestions'])->name('quizzes.bulk-questions');
    Route::post('/quizzes/{quiz}/publish', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'publish'])->name('quizzes.publish');
    Route::post('/quizzes/{quiz}/unpublish', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'unpublish'])->name('quizzes.unpublish');
    Route::post('/quizzes/{quiz}/promote', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'calculateAndPromote'])->name('quizzes.promote');
    Route::delete('/questions/{question}', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'deleteQuestion'])->name('questions.destroy');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);
    Route::post('/testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');

    // Industry Experts
    Route::resource('industry-experts', IndustryExpertController::class);
    Route::post('/industry-experts/{industry_expert}/toggle-status', [IndustryExpertController::class, 'toggleStatus'])->name('industry-experts.toggle-status');
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
    Route::get('/wallet', [SyndicateController::class, 'wallet'])->name('wallet');
});

Route::middleware(['auth', 'sales_agent'])->prefix('sales-agent')->name('sales-agent.')->group(function () {
    Route::get('/dashboard', [SalesAgentController::class, 'index'])->name('dashboard');
    Route::get('/merchants', [SalesAgentController::class, 'merchants'])->name('merchants');
    Route::post('/merchants', [SalesAgentController::class, 'storeMerchant'])->name('merchants.store');
    Route::get('/wallet', [SalesAgentController::class, 'wallet'])->name('wallet');
    Route::get('/kyc', [SalesAgentController::class, 'kyc'])->name('kyc');
    Route::post('/kyc', [SalesAgentController::class, 'submitKyc'])->name('kyc.submit');
    Route::post('/payout/request', [SalesAgentController::class, 'submitPayoutRequest'])->name('payout.submit');
});

Route::middleware(['auth', 'teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'index'])->name('dashboard');
    Route::get('/students', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'students'])->name('students');
    Route::get('/students/create', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'createStudent'])->name('students.create');
    Route::post('/students', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'addStudent'])->name('students.add');
    Route::get('/students/{student}/edit', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'editStudent'])->name('students.edit');
    Route::put('/students/{student}', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'updateStudent'])->name('students.update');
    Route::get('/students/{student}/progress', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'studentProgress'])->name('students.progress');
    Route::post('/students/{student}/add-money', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'addMoney'])->name('students.add-money');

    // Quizzes
    Route::resource('quizzes', App\Http\Controllers\Backend\Teacher\QuizController::class);
    Route::get('quizzes/sample-csv', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'downloadSampleCSV'])->name('quizzes.sample-csv');
    Route::get('quizzes/{quiz}/results', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'results'])->name('quizzes.results');
    Route::post('quizzes/{quiz}/questions', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'addQuestion'])->name('quizzes.add-question');
    Route::post('quizzes/{quiz}/bulk-questions', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'addBulkQuestions'])->name('quizzes.bulk-questions');
    Route::post('quizzes/{quiz}/publish', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'publish'])->name('quizzes.publish');
    Route::post('quizzes/{quiz}/unpublish', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'unpublish'])->name('quizzes.unpublish');
    Route::post('quizzes/{quiz}/promote', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'calculateAndPromote'])->name('quizzes.promote');
    Route::delete('questions/{question}', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'deleteQuestion'])->name('questions.destroy');

    // Wallet & KYC
    Route::get('/wallet', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'wallet'])->name('wallet');
    Route::get('/kyc', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'kyc'])->name('kyc');
    Route::post('/kyc', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'submitKyc'])->name('kyc.submit');
    Route::post('/payout/request', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'submitPayoutRequest'])->name('payout.submit');

    // Courses (LMS)
    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
    Route::post('courses/{course}/subjects', [CourseController::class, 'addSubject'])->name('courses.add-subject');
    Route::post('subjects/{subject}/topics', [CourseController::class, 'addTopic'])->name('subjects.add-topic');
    Route::post('topics/{topic}/contents', [CourseController::class, 'addContent'])->name('topics.add-content');
    Route::put('contents/{content}', [CourseController::class, 'updateContent'])->name('contents.update');
    Route::delete('contents/{content}', [CourseController::class, 'deleteContent'])->name('contents.destroy');
});

Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Backend\Student\StudentController::class, 'index'])->name('dashboard');

    // Exams & Security
    Route::get('/exams', [App\Http\Controllers\Backend\Student\StudentController::class, 'exams'])->name('exams');
    Route::get('/exams/{quiz}', [App\Http\Controllers\Backend\Student\StudentController::class, 'showExam'])->name('exams.show');
    Route::post('/exams/{quiz}/enroll', [App\Http\Controllers\Backend\Student\StudentController::class, 'enrollExam'])->name('exams.enroll');
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

    // Wallet
    Route::get('/wallet', [App\Http\Controllers\Backend\Student\StudentController::class, 'wallet'])->name('wallet');
});
