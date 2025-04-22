<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\PeminjamanController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-user', [BukuController::class, 'index']);
    Route::post('/buku', [BukuController::class, 'store']);
    
    Route::post('/pinjam', [PeminjamanController::class, 'pinjam']);
    Route::post('/kembalikan', [PeminjamanController::class, 'kembalikan']);
});