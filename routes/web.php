<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AiController;
use App\Http\Controllers\LandingController;

// AI Interface (Public)
Route::get('/ai', [AiController::class, 'index'])->name('ai.index');
Route::post('/ai/ask', [AiController::class, 'ask'])->name('ai.ask');

// Halaman Publik Landing
Route::get('/', function () { return view('welcome'); })->name('home');
Route::get('/fakultas', [LandingController::class, 'fakultas'])->name('fakultas.index');
Route::get('/program-studi', [LandingController::class, 'programStudi'])->name('program-studi.index');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [LandingController::class, 'kirimKontak'])->name('kontak.kirim');

// Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Administrator Area
use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Informasi Institusi
    Route::resource('users', UserController::class);
    Route::resource('fakultas', FakultasController::class);
    Route::resource('program-studi', ProgramStudiController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('faq', FaqController::class)->except(['show', 'create', 'edit']);

    // AI Activity Logs
    Route::post('faq/{faq}/toggle', [FaqController::class, 'toggleActive'])->name('faq.toggle');
    Route::post('faq-log/{log}/approve', [FaqController::class, 'approveSuggestion'])->name('faq.approve-log');
    Route::post('faq-log/{log}/promote', [FaqController::class, 'promoteLog'])->name('faq.promote-log');
    Route::post('faq-log/{log}/dismiss', [FaqController::class, 'dismissLog'])->name('faq.dismiss-log');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
