<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;

// Hapus route closure pertama yang duplikat
Route::get('/', function () {
    return view('auth.login');
})->name('login_user');

// Auth routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit'); // Ubah nama route

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit'); // Konsisten dengan penamaan

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-user', [BookController::class, 'index']);
    Route::post('/buku', [BookController::class, 'store']);

    Route::post('/pinjam', [PeminjamanController::class, 'pinjam']);
    Route::post('/kembalikan', [PeminjamanController::class, 'kembalikan']);

    Route::resource('kategori', CategoryController::class);
});