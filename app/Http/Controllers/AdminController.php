<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    
    public function dashboard()
    {
        return view('admin.AdminDashboard');
    }
}
