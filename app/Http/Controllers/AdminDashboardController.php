<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalLoans = Loan::count();
        $books = Book::all(); // ambil semua buku juga
        
        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'totalLoans', 'books'));
    }
}
