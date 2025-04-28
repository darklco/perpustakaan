<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Fungsi untuk meminjam buku
     */
    public function pinjam(Request $request)
    {
        // validasi 
        $buku = Book::findOrFail($request->id_buku);
        
        if ($buku->stok < 1) {
            return back()->with('error', 'Stok habis');
        }
        
        // Buat peminjaman baru
        Peminjaman::create([
            'user_id' => auth()->id(),
            'book_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'jatuh_tempo' => now()->addDays(4),
            'status' => 'dipinjam'
        ]);
        
        // Kurangi stok
        $buku->decrement('stok');
        
        return back()->with('success', 'Buku berhasil dipinjam');
    }
    
    /**
     * Fungsi untuk mengembalikan buku
     */
    public function kembalikan(Request $request)
    {
        $peminjaman = Peminjaman::findOrFail($request->id);
        $tanggal_kembali = Carbon::now();
        
        $peminjaman->tanggal_kembali = $tanggal_kembali;
        $peminjaman->status = 'dikembalikan';
        
        // Hitung denda
        $jatuh_tempo = Carbon::parse($peminjaman->jatuh_tempo);
        $hari_terlambat = $tanggal_kembali->diffInDays($jatuh_tempo, false);
        
        $denda = 0;
        if ($hari_terlambat < 0) {
            $hari_telat = abs($hari_terlambat);
            $denda_per_hari = 1000;
            $denda = $hari_telat * $denda_per_hari;
        }
        
        $peminjaman->save();
        
        // Tambah stok buku
        $peminjaman->book->increment('stok');
        
        return back()->with('success', "Buku berhasil dikembalikan. Denda: Rp " . number_format($denda));
    }
    
    /**
     * Fungsi untuk menampilkan form peminjaman
     */
    public function formPinjam($id)
    {
        $buku = Book::findOrFail($id);
        return view('peminjaman', compact('buku'));
    }

    
}