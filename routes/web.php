<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AiController;
use App\Http\Controllers\LandingController;

// AI
Route::get('/ai', [AiController::class, 'index'])->name('ai.index');

// Halaman Publik Landing
Route::get('/fakultas', [LandingController::class, 'fakultas'])->name('fakultas.index');
Route::get('/program-studi', [LandingController::class, 'programStudi'])->name('program-studi.index');
Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [LandingController::class, 'kirimKontak'])->name('kontak.kirim');
Route::post('/ai/ask', [AiController::class, 'ask'])->name('ai.ask');

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

use App\Http\Controllers\Admin\FakultasController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Admin\MataKuliahController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\Admin\KrsController;

use App\Http\Controllers\Admin\DashboardController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('fakultas', FakultasController::class);
    Route::resource('program-studi', ProgramStudiController::class);
    Route::resource('mata-kuliah', MataKuliahController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('dosen', DosenController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::resource('krs', KrsController::class);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
