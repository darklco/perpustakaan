<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Route Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Route Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');

// Route Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route yang hanya bisa diakses oleh user yang sudah login
Route::middleware(['auth'])->group(function () {

    // Route untuk pengguna biasa
    Route::get('/dashboard-user', [BookController::class, 'index']);
    Route::post('/buku', [BookController::class, 'store']);
    Route::post('/pinjam', [PeminjamanController::class, 'pinjam']);
    Route::post('/kembalikan', [PeminjamanController::class, 'kembalikan']);

    Route::resource('kategori', CategoryController::class);

    // Route khusus admin
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    });
});
