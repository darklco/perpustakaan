<?php

namespace App\Http\Controllers;

use App\Models\peminjaman;
use Illuminate\Http\Request;

class Admin extends Controller
{
    public function riwayat()
{
    $riwayat = peminjaman::with(['user', 'book'])->get();
    return view('admin.riwayat', compact('riwayat'));
}
}
