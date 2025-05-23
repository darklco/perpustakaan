<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import View Facade
use App\Models\Peminjaman; // Import model Peminjaman
use App\Models\Book;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('peminjamans', Peminjaman::where('status', 'dipinjam')->get());
            $view->with('bestSellers', Book::with('category')->take(7)->get());
        });

        
    }
}