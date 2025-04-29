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

// Public routes untuk buku
Route::get('/buku', [PeminjamanController::class, 'index'])->name('buku'); // <<<--- diperbaiki ke PeminjamanController
Route::get('/buku/{id}', [BookController::class, 'show'])->name('showbuku');
Route::get('/buku/kategori/{kategori}', [BookController::class, 'filterKategoriuser'])->name('buku.kategori');

// Jika ingin ada POST ke /buku, misal untuk menambah buku atau pencarian
Route::post('/buku', [BookController::class, 'store'])->name('buku.store');

Route::middleware(['auth'])->group(function () {
    // Route index setelah login
    Route::get('/', [AuthController::class, 'index'])->name('index');

    // Dashboard user
    Route::get('/dashboard-user', [AuthController::class, 'index'])->name('dashboard.user');

    // Dashboard admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AuthController::class, 'dashboard'])->name('DashboardAdmin');

        // CRUD Buku Admin
        Route::resource('books', BookController::class);

        // CRUD Kategori Admin
        Route::resource('kategori', CategoryController::class);

        // Admin filter dan search
        Route::get('/admin/buku/kategori', [BookController::class, 'filterKategori'])->name('filterKategori');
        Route::get('/admin/buku/search', [BookController::class, 'search'])->name('buku.search');
    });

    // Peminjaman buku
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/form/{id}', [PeminjamanController::class, 'formPinjam'])->name('peminjaman.form');
    Route::post('/peminjaman/pinjam', [PeminjamanController::class, 'pinjam'])->name('peminjaman.pinjam');
    Route::post('/peminjaman/kembalikan', [PeminjamanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
});
