<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category; 
class BookController extends Controller
{
    // Menampilkan semua buku
    public function index()
    {
        $books = Book::all();
        return view('buku', compact('books'));
    }
    
    public function filterKategoriuser($kategori)
    {
        // Cari buku berdasarkan nama kategori

        $categories = Category::all();
        $books = Book::whereHas('category', function($query) use ($kategori) {
            $query->where('name', $kategori);
        })->get();
    
        return view('buku', compact('books', 'categories'));
    }

    public function filterKategori(Request $request)
    {
        $kategoriId = $request->kategori;
        $categories = Category::all(); // untuk select dropdown
        $books = Book::where('category_id', $kategoriId)->get();
    
        return view('DashboardAdmin', compact('books', 'categories'));
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $categories = Category::all(); // untuk select dropdown
        $books = Book::where('judul', 'like', "%$keyword%")->get();
    
        return view('nama_view_admin', compact('books', 'categories'));
    }

    // Menampilkan halaman dashboard admin
    public function dashboard()
    {
        $books = Book::all();
        return view('DashboardAdmin', compact('books'));
    }
    
    // Menampilkan form tambah buku
    public function create()
    {
        $categories = Category::all(); // Tambahkan data kategori
        return view('books.create', compact('categories')); // Kirim data kategori ke view
    }
    
    // Menyimpan buku baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required', // konsisten pakai category_id
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('books', 'public');
        }
        
        Book::create($validated);
        
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }
    
    // Menampilkan form edit buku
    public function edit(Book $book)
    {
        $categories = Category::all(); // Tambahkan data kategori
        return view('editbuku', compact('book', 'categories')); // Kirim data kategori ke view
    }
    
    // Update data buku
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required', // konsisten
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($book->foto) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $book->foto);
            }
            
            $validated['foto'] = $request->file('foto')->store('books', 'public');
        }
        
        $book->update($validated);
        
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }
    
    // Menghapus buku
    public function destroy(Book $book)
    {
        // Hapus file foto jika ada
        if ($book->foto) {
            \Illuminate\Support\Facades\Storage::delete('public/' . $book->foto);
        }
        
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }

    public function formPinjam($id)
    {
        // Get the book by ID
        $book = Book::findOrFail($id);
        
        // Return the view with the book data
        return view('peminjaman.form', compact('book'));
    }

    public function pinjam(Request $request)
    {
        // Logic to process the book loan
        // ...
        
        return redirect()->route('dashboard.user')->with('success', 'Buku berhasil dipinjam');
    }

    public function show ($id){
        $book = Book::findOrFail($id);
        return view('showbuku', compact('book'));
    }
}