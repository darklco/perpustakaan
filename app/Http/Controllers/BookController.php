<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\buku;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function store(Request $request)
    {
        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
            'admin_id' => auth()->id(),
        ]);
        return redirect()->back()->with('success', 'Buku ditambahkan');
    }
}
