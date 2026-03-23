<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () { return view('frontend.index'); })->name('home');
Route::get('/about', function () { return view('frontend.about'); })->name('about');
Route::get('/process', function () { return view('frontend.process'); })->name('process');
Route::get('/returns', function () { return view('frontend.returns'); })->name('returns');
Route::get('/sectors/marriage-halls', function () { return view('frontend.marriage-halls'); })->name('sectors.marriage-halls');
Route::get('/sectors/education', function () { return view('frontend.education'); })->name('sectors.education');
Route::get('/sectors/coaching', function () { return view('frontend.coaching'); })->name('sectors.coaching');
Route::get('/privacy-policy', function () { return view('frontend.privacy'); })->name('privacy');
Route::get('/terms-of-use', function () { return view('frontend.terms'); })->name('terms');

