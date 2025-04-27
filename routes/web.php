<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminDashboardController;

// Auth routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public route
Route::get('/buku', [BookController::class, 'index'])->name('buku');

// Routes untuk user dan admin setelah login
Route::middleware(['auth'])->group(function () {
    // Route index setelah login
    Route::get('/', [AuthController::class, 'index'])->name('index');

    // Dashboard user
    Route::get('/dashboard-user', [AuthController::class, 'index'])->name('dashboard.user');

    // Dashboard admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AuthController::class, 'dashboard'])->name('DashboardAdmin');
    });

    // CRUD Buku
    Route::resource('books', BookController::class);

    // CRUD Kategori
    Route::resource('kategori', CategoryController::class);

    // Peminjaman
    Route::post('/pinjam', [PeminjamanController::class, 'pinjam'])->name('pinjam.store');
    Route::post('/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('pinjam.kembalikan');
});
