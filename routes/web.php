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

// Public routes
Route::get('/buku', [BookController::class, 'index'])->name('buku');

// Jika ingin ada POST ke /buku, misal untuk menambah buku atau pencarian
Route::post('/buku', [BookController::class, 'store'])->name('buku.store');

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


    Route::post('/peminjaman/pinjam', [PeminjamanController::class, 'pinjam'])->name('peminjaman.pinjam');
    Route::get('/peminjaman/form/{id}', [PeminjamanController::class, 'formPinjam'])->name('peminjaman.form');
    
    // Public route untuk melihat detail buku
    Route::get('/buku/{id}', [BookController::class, 'show'])->name('showbuku');

    // kategori
    Route::get('/buku/kategori/{kategori}', [BookController::class, 'filterKategori'])->name('buku.kategori');
    


});
