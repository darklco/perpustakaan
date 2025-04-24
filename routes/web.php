<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
    // return view('welcome');
// });

//views
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', function () {
    return view('auth.login_user');
})->name('login_user');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-user', [BookController::class, 'index']);
    Route::post('/buku', [BookController::class, 'store']);

    Route::post('/pinjam', [PeminjamanController::class, 'pinjam']);
    Route::post('/kembalikan', [PeminjamanController::class, 'kembalikan']);

    Route::resource('kategori', CategoryController::class);

    // Tambahkan blok middleware admin DI DALAM middleware auth
    // Route::middleware(['admin'])->group(function () {
        // Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // });
});