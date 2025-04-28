<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        return redirect()->route('login')->with('success', 'Register berhasil.');
    }
    
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
        
            if (auth()->user()->role === 'admin') {
                return redirect()->route('DashboardAdmin');
            } else {
                return redirect()->route('index');
            }
        }
        
        
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
    
    public function logout(Request $request)
    {
        // Simpan role user sebelum logout
        $userRole = Auth::user() ? Auth::user()->role : null;
        
        // Proses logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect berdasarkan role yang disimpan sebelumnya
        if ($userRole === 'admin') {
            return redirect()->route('DashboardAdmin');
        } else {
            return redirect()->route('index');
        }
    }
    
    public function index()
    {
        return view('index'); // pastikan view ini ada
    }

    public function dashboard()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('dashboardadmin', compact('books', 'categories')); // pastikan ada file resources/views/dashboardadmin.blade.php
    }      
}