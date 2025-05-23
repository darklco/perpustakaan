<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Middleware auth untuk semua method
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Halaman utama peminjaman
     */
    public function index()
    {
        $books = Book::all();
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        
        return view('buku', compact('books', 'peminjamans'));
    }
    
    /**
     * Proses peminjaman buku
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
        
        return redirect()->route('peminjaman.tabel')->with('success', 'Buku berhasil dipinjam!');
    }

    /**
     * Menampilkan tabel peminjaman
     */
    public function showTabel()
    {
        $peminjamans = Peminjaman::with('book')->where('user_id', auth()->id())->get();
        
        // Tidak perlu menambahkan jatuh_tempo_text di sini karena sudah ada accessor di model
        
        return view('peminjaman.tabel', compact('peminjamans'));
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

    public function returnBook($id)
{
    $peminjaman = Peminjaman::findOrFail($id);
    
    // Cek apakah buku sudah dikembalikan
    if ($peminjaman->status == 'dikembalikan') {
        return redirect()->route('admin.riwayat')->with('error', 'Buku sudah dikembalikan.');
    }

    // Update status peminjaman dan tanggal kembali
    $peminjaman->status = 'dikembalikan';
    $peminjaman->tanggal_kembali = now(); // Atau format tanggal sesuai keinginan
    $peminjaman->save();

    return redirect()->route('admin.riwayat')->with('success', 'Buku berhasil dikembalikan.');
}

}