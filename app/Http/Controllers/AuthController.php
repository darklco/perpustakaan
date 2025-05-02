<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan form registrasi
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // default role
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('DashboardAdmin');
        }
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (auth()->user()->role === 'admin') {
                return redirect()->route('DashboardAdmin')->with('success', 'Login berhasil sebagai admin.');
            } else {
                return redirect()->route('index')->with('success', 'Login berhasil.');
            }
        }
        

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput(['email' => $request->email]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        $userRole = Auth::user() ? Auth::user()->role : null;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($userRole === 'admin') {
            return redirect()->route('login')->with('success', 'Logout berhasil.');
        } else {
            return redirect()->route('login')->with('success', 'Logout berhasil.');
        }
    }

    // Halaman utama (user biasa)
    public function index()
    {
        return view('index');
    }

    // Dashboard admin
    public function dashboard()
    {
        $books = Book::all();
        $categories = Category::all();

        return view('dashboardadmin', compact('books', 'categories'));
    }

    public function account()
    {
        return view('admin.account');
    }

}
