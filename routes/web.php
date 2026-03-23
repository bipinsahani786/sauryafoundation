<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Backend\Admin\AdminController;
use App\Http\Controllers\Backend\Admin\PlanController;
use App\Http\Controllers\Backend\Admin\UserController;
use App\Http\Controllers\Backend\Syndicate\SyndicateController;
use App\Http\Controllers\Backend\ProfileController;

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
