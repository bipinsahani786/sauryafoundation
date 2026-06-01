<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CharityController;
use App\Http\Controllers\Frontend\EventController as FrontendEventController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Backend\Admin\ContactMessageController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\CharityController as AdminCharityController;
use App\Http\Controllers\Backend\Admin\PlanController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Admin\BannerController;
use App\Http\Controllers\Backend\Admin\PartnerController;
use App\Http\Controllers\Backend\Admin\HomeSectorController;
use App\Http\Controllers\Backend\Admin\TestimonialController;
use App\Http\Controllers\Backend\Admin\IndustryExpertController;
use App\Http\Controllers\Backend\Admin\EventController as AdminEventController;
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

// Mega Menu Routes
Route::prefix('about')->name('about.')->group(function () {
    Route::view('mission', 'frontend.pages.about.mission')->name('mission');
    Route::view('vision', 'frontend.pages.about.vision')->name('vision');
    Route::view('team', 'frontend.pages.about.team')->name('team');
    Route::view('partners', 'frontend.pages.about.partners')->name('partners');
    Route::view('reports', 'frontend.pages.about.reports')->name('reports');
});

Route::prefix('work')->name('work.')->group(function () {
    Route::view('/our-work', 'frontend.pages.work.index')->name('index');
    Route::prefix('projects')->name('projects.')->group(function () {
        Route::view('ongoing', 'frontend.pages.work.projects.ongoing')->name('ongoing');
        Route::view('completed', 'frontend.pages.work.projects.completed')->name('completed');
        Route::view('upcoming', 'frontend.pages.work.projects.upcoming')->name('upcoming');
    });
    Route::view('campaigns', 'frontend.pages.work.campaigns')->name('campaigns');
    Route::view('awareness', 'frontend.pages.work.awareness')->name('awareness');
});

Route::prefix('media')->name('media.')->group(function () {
    Route::view('/media-and-stories', 'frontend.pages.media.index')->name('index');
    Route::view('blog', 'frontend.pages.media.blog')->name('blog');
    Route::view('updates', 'frontend.pages.media.updates')->name('updates');
    Route::view('stories', 'frontend.pages.media.stories')->name('stories');
    Route::view('videos', 'frontend.pages.media.videos')->name('videos');
});

Route::prefix('involved')->name('involved.')->group(function () {
    Route::view('/', 'frontend.pages.involved.index')->name('index');
    Route::view('volunteer', 'frontend.pages.involved.volunteer')->name('volunteer');
    Route::view('internship', 'frontend.pages.involved.internship')->name('internship');
    Route::view('partner', 'frontend.pages.involved.partner')->name('partner');
    Route::view('donate', 'frontend.pages.involved.donate')->name('donate');
    Route::view('support', 'frontend.pages.involved.support')->name('support');
    Route::post('submit', [App\Http\Controllers\Frontend\ApplicationController::class, 'store'])->name('submit');
});

Route::get('events', [FrontendEventController::class, 'index'])->name('events');
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::post('contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/charity/donate', [CharityController::class, 'store'])->name('charity.donate');

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
    Route::get('/docs', [AdminController::class, 'docs'])->name('docs');
    Route::get('/applications', [AdminController::class, 'applications'])->name('applications')->middleware('permission:view_applications');

    // Contact Messages
    Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::post('contact-messages/{contactMessage}/status', [ContactMessageController::class, 'updateStatus'])->name('contact-messages.status');
    Route::delete('contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

    // Events Management
    Route::get('events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event}', [AdminEventController::class, 'update'])->name('events.update');
    Route::post('events/{event}/toggle-status', [AdminEventController::class, 'toggleStatus'])->name('events.toggle-status');
    Route::delete('events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    // Get Involved Applications
    Route::get('/applications-list', [App\Http\Controllers\Admin\ApplicationController::class, 'index'])->name('applications.index');
    Route::post('/applications-list/{id}/status', [App\Http\Controllers\Admin\ApplicationController::class, 'updateStatus'])->name('applications.status');

    Route::middleware('permission:view_plans')->group(function () {
        Route::get('plans', [PlanController::class, 'index'])->name('plans.index');
        
        Route::get('plans/create', [PlanController::class, 'create'])->name('plans.create')->middleware('permission:create_plans');
        Route::post('plans', [PlanController::class, 'store'])->name('plans.store')->middleware('permission:create_plans');
        
        Route::get('plans/{plan}', [PlanController::class, 'show'])->name('plans.show');
        
        Route::get('plans/{plan}/edit', [PlanController::class, 'edit'])->name('plans.edit')->middleware('permission:edit_plans');
        Route::put('plans/{plan}', [PlanController::class, 'update'])->name('plans.update')->middleware('permission:edit_plans');
        Route::post('/plans/{plan}/toggle-status', [PlanController::class, 'toggleStatus'])->name('plans.toggle-status')->middleware('permission:edit_plans');
        
        Route::delete('plans/{plan}', [PlanController::class, 'destroy'])->name('plans.destroy')->middleware('permission:delete_plans');
    });

    Route::middleware('permission:view_subscriptions')->group(function () {
        Route::get('/subscriptions', [AdminController::class, 'subscriptions'])->name('subscriptions');
        Route::post('/subscriptions/{subscription}/approve', [AdminController::class, 'approveSubscription'])->name('subscriptions.approve')->middleware('permission:approve_payments');
        Route::post('/subscriptions/{subscription}/reject', [AdminController::class, 'rejectSubscription'])->name('subscriptions.reject')->middleware('permission:approve_payments');
    });

    Route::middleware('permission:view_users')->group(function () {
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/export/csv', [UserController::class, 'exportCsv'])->name('users.export.csv');
        Route::get('users/export/pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf');
        
        Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create_users');
        Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('permission:create_users');
        
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit_users');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit_users');
        Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status')->middleware('permission:edit_users');
        Route::post('/users/{user}/impersonate', [UserController::class, 'impersonate'])->name('users.impersonate')->middleware('permission:impersonate_users');
        
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete_users');
    });

    // Website Settings
    Route::middleware('permission:view_settings')->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update')->middleware('permission:update_settings');
    });

    // Payouts & KYC Management
    Route::middleware('permission:view_payouts')->group(function () {
        Route::get('/payouts', [AdminController::class, 'payouts'])->name('payouts.index');
        Route::post('/kyc/{user}/verify', [AdminController::class, 'verifyKyc'])->name('kyc.verify')->middleware('permission:verify_kyc');
        Route::post('/payouts/{payout}/approve', [AdminController::class, 'approvePayout'])->name('payout.approve')->middleware('permission:approve_payouts');
    });

    // Charity Funds
    Route::get('/charity-funds', [AdminCharityController::class, 'index'])->name('charity.index');
    Route::post('/charity-funds/settings', [AdminCharityController::class, 'updateSettings'])->name('charity.settings');
    Route::patch('/charity-funds/{charityDonation}', [AdminCharityController::class, 'update'])->name('charity.update');

    // Dynamic Classes Management
    Route::middleware('permission:view_classes')->group(function () {
        Route::get('student-classes', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'index'])->name('student-classes.index');
        
        Route::get('student-classes/create', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'create'])->name('student-classes.create')->middleware('permission:create_classes');
        Route::post('student-classes', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'store'])->name('student-classes.store')->middleware('permission:create_classes');
        
        Route::get('student-classes/{student_class}/edit', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'edit'])->name('student-classes.edit')->middleware('permission:edit_classes');
        Route::put('student-classes/{student_class}', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'update'])->name('student-classes.update')->middleware('permission:edit_classes');
        Route::post('/student-classes/{student_class}/toggle-status', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'toggleStatus'])->name('student-classes.toggle-status')->middleware('permission:edit_classes');
        Route::delete('student-classes/{student_class}', [\App\Http\Controllers\Backend\Admin\StudentClassController::class, 'destroy'])->name('student-classes.destroy')->middleware('permission:delete_classes');

        // Study Materials
        Route::resource('study-materials', \App\Http\Controllers\Backend\Admin\StudyMaterialController::class);
        Route::post('study-materials/{study_material}/toggle-status', [\App\Http\Controllers\Backend\Admin\StudyMaterialController::class, 'toggleStatus'])->name('study-materials.toggle-status');
    });

    // Academy Management (LMS)
    Route::middleware('permission:view_settings')->group(function () {
        Route::resource('courses', \App\Http\Controllers\Backend\Admin\CourseController::class);
        Route::post('courses/{course}/publish', [\App\Http\Controllers\Backend\Admin\CourseController::class, 'publish'])->name('courses.publish');
        Route::post('courses/{course}/subjects', [\App\Http\Controllers\Backend\Admin\CourseController::class, 'addSubject'])->name('courses.add-subject');
        Route::post('subjects/{subject}/topics', [\App\Http\Controllers\Backend\Admin\CourseController::class, 'addTopic'])->name('subjects.add-topic');
        Route::post('topics/{topic}/contents', [\App\Http\Controllers\Backend\Admin\CourseController::class, 'addContent'])->name('topics.add-content');
        Route::put('contents/{content}', [\App\Http\Controllers\Backend\Admin\CourseController::class, 'updateContent'])->name('contents.update');
        Route::delete('contents/{content}', [\App\Http\Controllers\Backend\Admin\CourseController::class, 'deleteContent'])->name('contents.destroy');
    });

    // Home Banners
    Route::middleware('permission:view_banners')->group(function () {
        Route::get('banners', [BannerController::class, 'index'])->name('banners.index');
        Route::get('banners/create', [BannerController::class, 'create'])->name('banners.create')->middleware('permission:create_banners');
        Route::post('banners', [BannerController::class, 'store'])->name('banners.store')->middleware('permission:create_banners');
        Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit')->middleware('permission:edit_banners');
        Route::put('banners/{banner}', [BannerController::class, 'update'])->name('banners.update')->middleware('permission:edit_banners');
        Route::post('/banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status')->middleware('permission:edit_banners');
        Route::delete('banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy')->middleware('permission:delete_banners');

        // Partners Routes
        Route::get('partners', [PartnerController::class, 'index'])->name('partners.index');
        Route::get('partners/create', [PartnerController::class, 'create'])->name('partners.create');
        Route::post('partners', [PartnerController::class, 'store'])->name('partners.store');
        Route::get('partners/{partner}/edit', [PartnerController::class, 'edit'])->name('partners.edit');
        Route::put('partners/{partner}', [PartnerController::class, 'update'])->name('partners.update');
        Route::post('/partners/{partner}/toggle-status', [PartnerController::class, 'toggleStatus'])->name('partners.toggle-status');
        Route::delete('partners/{partner}', [PartnerController::class, 'destroy'])->name('partners.destroy');
    });

    // Home Sectors
    Route::middleware('permission:view_sectors')->group(function () {
        Route::get('home-sectors', [HomeSectorController::class, 'index'])->name('home-sectors.index');
        Route::get('home-sectors/create', [HomeSectorController::class, 'create'])->name('home-sectors.create')->middleware('permission:create_sectors');
        Route::post('home-sectors', [HomeSectorController::class, 'store'])->name('home-sectors.store')->middleware('permission:create_sectors');
        Route::get('home-sectors/{home_sector}/edit', [HomeSectorController::class, 'edit'])->name('home-sectors.edit')->middleware('permission:edit_sectors');
        Route::put('home-sectors/{home_sector}', [HomeSectorController::class, 'update'])->name('home-sectors.update')->middleware('permission:edit_sectors');
        Route::post('/home-sectors/{home_sector}/toggle-status', [HomeSectorController::class, 'toggleStatus'])->name('home-sectors.toggle-status')->middleware('permission:edit_sectors');
        Route::delete('home-sectors/{home_sector}', [HomeSectorController::class, 'destroy'])->name('home-sectors.destroy')->middleware('permission:delete_sectors');
    });

    // Exam Management
    Route::middleware('permission:view_exams')->group(function () {
        Route::get('/quiz-approvals', [AdminController::class, 'quizzes'])->name('quiz-approvals');
        Route::post('/quiz-approvals/{quiz}/approve', [AdminController::class, 'approveQuiz'])->name('quiz-approvals.approve')->middleware('permission:approve_exams');
        Route::post('/quiz-approvals/{quiz}/reject', [AdminController::class, 'rejectQuiz'])->name('quiz-approvals.reject')->middleware('permission:approve_exams');

        Route::get('quizzes', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'index'])->name('quizzes.index');
        
        Route::get('quizzes/create', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'create'])->name('quizzes.create')->middleware('permission:create_exams');
        Route::post('quizzes', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'store'])->name('quizzes.store')->middleware('permission:create_exams');
        
        Route::get('quizzes/{quiz}', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'show'])->name('quizzes.show');
        Route::get('quizzes/{quiz}/edit', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'edit'])->name('quizzes.edit')->middleware('permission:edit_exams');
        Route::put('quizzes/{quiz}', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'update'])->name('quizzes.update')->middleware('permission:edit_exams');
        Route::delete('quizzes/{quiz}', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'destroy'])->name('quizzes.destroy')->middleware('permission:edit_exams');
        
        Route::get('/quizzes/{quiz}/results', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'results'])->name('quizzes.results');
        Route::get('/quizzes/sample-csv', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'downloadSampleCSV'])->name('quizzes.sample-csv');
        Route::post('/quizzes/{quiz}/questions', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'addQuestion'])->name('quizzes.add-question')->middleware('permission:edit_exams');
        Route::post('/quizzes/{quiz}/bulk-questions', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'addBulkQuestions'])->name('quizzes.bulk-questions')->middleware('permission:edit_exams');
        Route::post('/quizzes/{quiz}/publish', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'publish'])->name('quizzes.publish')->middleware('permission:publish_exams');
        Route::post('/quizzes/{quiz}/unpublish', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'unpublish'])->name('quizzes.unpublish')->middleware('permission:publish_exams');
        Route::post('/quizzes/{quiz}/promote', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'calculateAndPromote'])->name('quizzes.promote')->middleware('permission:publish_exams');
        Route::delete('/questions/{question}', [\App\Http\Controllers\Backend\Admin\QuizController::class, 'deleteQuestion'])->name('questions.destroy')->middleware('permission:edit_exams');
        
        // Admit Cards
        Route::resource('admit-cards', \App\Http\Controllers\Backend\Admin\AdmitCardController::class);
        Route::get('admit-cards/{admit_card}/pdf', [\App\Http\Controllers\Backend\Admin\AdmitCardController::class, 'downloadPdf'])->name('admit-cards.pdf');
    });

    // Testimonials
    Route::middleware('permission:view_testimonials')->group(function () {
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
        Route::get('testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create')->middleware('permission:create_testimonials');
        Route::post('testimonials', [TestimonialController::class, 'store'])->name('testimonials.store')->middleware('permission:create_testimonials');
        Route::get('testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit')->middleware('permission:edit_testimonials');
        Route::put('testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('testimonials.update')->middleware('permission:edit_testimonials');
        Route::post('/testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status')->middleware('permission:edit_testimonials');
        Route::delete('testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy')->middleware('permission:delete_testimonials');
    });

    // Admin Wallet Management
    Route::middleware('permission:view_wallet')->group(function () {
        Route::get('/wallet', [App\Http\Controllers\Backend\Admin\WalletController::class, 'index'])->name('wallet.index');
        Route::get('/wallet/search-users', [App\Http\Controllers\Backend\Admin\WalletController::class, 'searchUsers'])->name('wallet.search-users');
        Route::post('/wallet/add', [App\Http\Controllers\Backend\Admin\WalletController::class, 'store'])->name('wallet.store')->middleware('permission:credit_wallet');
    });

    // Top-up Requests
    Route::middleware('permission:view_topup_requests')->group(function () {
        Route::get('wallet/topups', [\App\Http\Controllers\Backend\Admin\WalletTopupController::class, 'index'])->name('wallet.topups.index');
        Route::post('wallet/topups/{topup_request}/approve', [\App\Http\Controllers\Backend\Admin\WalletTopupController::class, 'approve'])->name('wallet.topup.approve')->middleware('permission:approve_topup_requests');
        Route::post('wallet/topups/{topup_request}/reject', [\App\Http\Controllers\Backend\Admin\WalletTopupController::class, 'reject'])->name('wallet.topup.reject')->middleware('permission:approve_topup_requests');
    });

    // Industry Experts
    Route::middleware('permission:view_industry_experts')->group(function () {
        Route::get('industry-experts', [IndustryExpertController::class, 'index'])->name('industry-experts.index');
        Route::get('industry-experts/create', [IndustryExpertController::class, 'create'])->name('industry-experts.create')->middleware('permission:create_industry_experts');
        Route::post('industry-experts', [IndustryExpertController::class, 'store'])->name('industry-experts.store')->middleware('permission:create_industry_experts');
        Route::get('industry-experts/{industry_expert}/edit', [IndustryExpertController::class, 'edit'])->name('industry-experts.edit')->middleware('permission:edit_industry_experts');
        Route::put('industry-experts/{industry_expert}', [IndustryExpertController::class, 'update'])->name('industry-experts.update')->middleware('permission:edit_industry_experts');
        Route::post('/industry-experts/{industry_expert}/toggle-status', [IndustryExpertController::class, 'toggleStatus'])->name('industry-experts.toggle-status')->middleware('permission:edit_industry_experts');
        Route::delete('industry-experts/{industry_expert}', [IndustryExpertController::class, 'destroy'])->name('industry-experts.destroy')->middleware('permission:delete_industry_experts');
        // Study Materials
        Route::resource('study-materials', \App\Http\Controllers\Backend\Admin\StudyMaterialController::class);

        // Finance & Ledger
        Route::middleware('permission:view_finance')->group(function () {
            Route::get('finance/ledger', [\App\Http\Controllers\Backend\Admin\FinanceController::class, 'ledger'])->name('finance.ledger');
        });

        // Activity Logs
        Route::middleware('permission:view_audit_logs')->group(function () {
            Route::get('activity-logs', [\App\Http\Controllers\Backend\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
        });
    });
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
    Route::get('/wallet/topup', [SyndicateController::class, 'topup'])->name('wallet.topup');
    Route::post('/wallet/topup', [SyndicateController::class, 'submitTopup'])->name('wallet.topup.submit');
});

Route::middleware(['auth', 'sales_agent'])->prefix('sales-agent')->name('sales-agent.')->group(function () {
    Route::get('/dashboard', [SalesAgentController::class, 'index'])->name('dashboard');
    Route::get('/merchants', [SalesAgentController::class, 'merchants'])->name('merchants');
    Route::post('/merchants', [SalesAgentController::class, 'storeMerchant'])->name('merchants.store');
    Route::get('/wallet', [SalesAgentController::class, 'wallet'])->name('wallet');
    Route::get('/wallet/topup', [SalesAgentController::class, 'topup'])->name('wallet.topup');
    Route::post('/wallet/topup', [SalesAgentController::class, 'submitTopup'])->name('wallet.topup.submit');
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
        Route::get('/students/{student}/dashboard', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'studentDashboardView'])->name('students.dashboard');
        Route::post('/students/{student}/add-money', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'addMoney'])->name('students.add-money');

        // Banners
        Route::resource('banners', App\Http\Controllers\Backend\Admin\BannerController::class);

    Route::resource('quizzes', App\Http\Controllers\Backend\Teacher\QuizController::class);
    Route::get('quizzes/sample-csv', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'downloadSampleCSV'])->name('quizzes.sample-csv');
    Route::get('quizzes/{quiz}/results', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'results'])->name('quizzes.results');
    Route::post('quizzes/{quiz}/questions', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'addQuestion'])->name('quizzes.add-question');
    Route::post('quizzes/{quiz}/bulk-questions', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'addBulkQuestions'])->name('quizzes.bulk-questions');
    Route::post('quizzes/{quiz}/publish', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'publish'])->name('quizzes.publish');
    Route::post('quizzes/{quiz}/unpublish', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'unpublish'])->name('quizzes.unpublish');
    Route::post('quizzes/{quiz}/promote', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'calculateAndPromote'])->name('quizzes.promote');
    Route::get('questions/{question}/edit', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'editQuestion'])->name('questions.edit');
    Route::put('questions/{question}', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'updateQuestion'])->name('questions.update');
    Route::delete('questions/{question}', [App\Http\Controllers\Backend\Teacher\QuizController::class, 'deleteQuestion'])->name('questions.destroy');

    // Wallet & KYC
    Route::get('/wallet', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'wallet'])->name('wallet');
    Route::get('/wallet/topup', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'topup'])->name('wallet.topup');
    Route::post('/wallet/topup', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'submitTopup'])->name('wallet.topup.submit');
    Route::get('/kyc', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'kyc'])->name('kyc');
    Route::post('/kyc', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'submitKyc'])->name('kyc.submit');
    Route::post('/payout/request', [App\Http\Controllers\Backend\Teacher\TeacherController::class, 'submitPayoutRequest'])->name('payout.submit');

    // Courses (LMS)
    Route::resource('courses', CourseController::class);
    Route::post('courses/{course}/publish', [CourseController::class, 'publish'])->name('courses.publish');
    Route::post('courses/{course}/unpublish', [CourseController::class, 'unpublish'])->name('courses.unpublish');
    Route::post('courses/{course}/subjects', [CourseController::class, 'addSubject'])->name('courses.add-subject');
    Route::put('subjects/{subject}', [CourseController::class, 'updateSubject'])->name('subjects.update');
    Route::delete('subjects/{subject}', [CourseController::class, 'deleteSubject'])->name('subjects.destroy');
    Route::post('subjects/{subject}/topics', [CourseController::class, 'addTopic'])->name('subjects.add-topic');
    Route::put('topics/{topic}', [CourseController::class, 'updateTopic'])->name('topics.update');
    Route::delete('topics/{topic}', [CourseController::class, 'deleteTopic'])->name('topics.destroy');
    Route::post('topics/{topic}/contents', [CourseController::class, 'addContent'])->name('topics.add-content');
    Route::put('contents/{content}', [CourseController::class, 'updateContent'])->name('contents.update');
    Route::delete('contents/{content}', [CourseController::class, 'deleteContent'])->name('contents.destroy');
    // Study Materials
    Route::resource('study-materials', \App\Http\Controllers\Backend\Teacher\StudyMaterialController::class);
    Route::post('study-materials/{study_material}/toggle-status', [\App\Http\Controllers\Backend\Teacher\StudyMaterialController::class, 'toggleStatus'])->name('study-materials.toggle-status');
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
    Route::get('/courses', [\App\Http\Controllers\Backend\Student\StudentController::class, 'courses'])->name('courses.index');
    Route::get('/courses/{course}', [\App\Http\Controllers\Backend\Student\StudentController::class, 'showCourse'])->name('courses.show');
    Route::post('/courses/{course}/enroll', [\App\Http\Controllers\Backend\Student\StudentController::class, 'enroll'])->name('courses.enroll');
    Route::post('/content/{content}/complete', [\App\Http\Controllers\Backend\Student\StudentController::class, 'completeContent'])->name('content.complete');

    // Study Materials
    Route::get('/study-materials', [\App\Http\Controllers\Backend\Student\StudyMaterialController::class, 'index'])->name('study-materials.index');
    Route::get('/study-materials/{study_material}/download', [\App\Http\Controllers\Backend\Student\StudyMaterialController::class, 'download'])->name('study-materials.download');

    // Wallet
    Route::get('/wallet', [App\Http\Controllers\Backend\Student\StudentController::class, 'wallet'])->name('wallet');

    // Admit Cards
    Route::get('/admit-cards', [App\Http\Controllers\Backend\Student\StudentController::class, 'admitCards'])->name('admit-cards.index');
    Route::get('/admit-cards/{admit_card}/pdf', [App\Http\Controllers\Backend\Student\StudentController::class, 'downloadAdmitCardPdf'])->name('admit-cards.pdf');
});
