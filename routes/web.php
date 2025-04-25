<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;

// Auth routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route index setelah login
Route::get('/index', [AuthController::class, 'index'])->name('index')->middleware('auth');

// Routes untuk user yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-user', [AuthController::class, 'index'])->name('dashboard.user');

    Route::post('/buku', [BookController::class, 'store'])->name('buku.store');

    Route::post('/pinjam', [PeminjamanController::class, 'pinjam'])->name('pinjam.store');
    Route::post('/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('pinjam.kembalikan');

    Route::resource('kategori', CategoryController::class);
});
