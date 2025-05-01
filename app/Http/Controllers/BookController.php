<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(12);
        $categories = Category::all();
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        $bestSellers = Book::with('category')->take(7)->get();

        return view('buku', compact('books', 'categories', 'peminjamans', 'bestSellers'));
    }

    public function homepage()
    {
        $bestSellers = Book::with('category')->take(7)->get(); 
        return view('index', compact('bestSellers'));
    }

    public function filterKategoriuser($kategori)
    {
        $categories = Category::all();
        $books = Book::whereHas('category', function($query) use ($kategori) {
            $query->where('name', $kategori);
        })->latest()->paginate(12);

        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        $bestSellers = Book::with('category')->take(7)->get();
        
        return view('buku', compact('books', 'categories', 'peminjamans', 'bestSellers'));
    }

    public function filterKategori(Request $request)
    {
        $query = Book::with('category');
    
        if ($request->kategori) {
            $query->where('category_id', $request->kategori);
        }

        if ($request->keyword) {
            $query->where('judul', 'like', '%' . $request->keyword . '%');
        }

        $books = $query->latest()->paginate(12);

        if ($request->ajax()) {
            return view('partials.table-buku', compact('books'))->render();
        }

        $categories = Category::all();
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        $bestSellers = Book::with('category')->take(7)->get();

        return view('dashboardadmin', [
            'books' => $books,
            'categories' => $categories,
            'peminjamans' => $peminjamans,
            'bestSellers' => $bestSellers,
            'section' => 'hapus'
        ]);
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;

        $books = Book::where('judul', 'like', "%$keyword%")
                    ->orWhere('penulis', 'like', "%$keyword%")
                    ->orWhere('penerbit', 'like', "%$keyword%")
                    ->orWhere('tahun_terbit', 'like', "%$keyword%")
                    ->latest()
                    ->paginate(12);

        if ($request->ajax()) {
            return view('partials.table-buku', compact('books'))->render();
        }

        $categories = Category::all();
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        $bestSellers = Book::with('category')->take(7)->get();

        return view('dashboardadmin', [
            'books' => $books,
            'categories' => $categories,
            'peminjamans' => $peminjamans,
            'bestSellers' => $bestSellers,
            'section' => 'hapus'
        ]);
    }

    public function searchuser(Request $request)
    {
        $query = $request->input('query');
        
        $books = Book::query();
        
        if ($query) {
            $books = $books->where('judul', 'like', '%' . $query . '%')
                        ->orWhere('penulis', 'like', '%' . $query . '%')
                        ->orWhere('penerbit', 'like', '%' . $query . '%');
        }
        
        $books = $books->latest()->paginate(12);
        
        $categories = Category::all();
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        $bestSellers = Book::with('category')->take(7)->get();
        
        return view('buku', compact('books', 'categories', 'peminjamans', 'bestSellers'));
    }

    public function dashboard()
    {
        $books = Book::latest()->paginate(12);
        $categories = Category::all();
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        $bestSellers = Book::with('category')->take(7)->get();
        
        return view('DashboardAdmin', compact('books', 'categories', 'peminjamans', 'bestSellers'));
    }

    public function create()
    {
        $categories = Category::all(); 
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        
        return view('books.create', compact('categories', 'peminjamans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('books', 'public');
        }
        
        Book::create($validated);
        
        return redirect()->route('DashboardAdmin')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        
        return view('editbuku', compact('book', 'categories', 'peminjamans'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
            'category_id' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        
        if ($request->hasFile('foto')) {
            if ($book->foto) {
                Storage::delete('public/' . $book->foto);
            }
            $validated['foto'] = $request->file('foto')->store('books', 'public');
        }
        
        $book->update($validated);
        
        return redirect()->route('DashboardAdmin')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->foto) {
            Storage::delete('public/' . $book->foto);
        }
        
        $book->delete();
        return redirect()->route('DashboardAdmin')->with('success', 'Buku berhasil dihapus.');
    }

    public function formPinjam($id)
    {
        $book = Book::findOrFail($id);
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        
        return view('peminjaman.form', compact('book', 'peminjamans'));
    }

    public function pinjam(Request $request)
    {
        return redirect()->route('dashboard.user')->with('success', 'Buku berhasil dipinjam');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        $bestSellers = Book::with('category')->take(7)->get();
        
        return view('showbuku', compact('book', 'peminjamans', 'bestSellers'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 1);
        $query = $request->input('query', '');
        $kategori = $request->input('kategori', '');
        
        $booksQuery = Book::query();
        
        if (!empty($query)) {
            $booksQuery->where(function($q) use ($query) {
                $q->where('judul', 'like', '%' . $query . '%')
                  ->orWhere('penulis', 'like', '%' . $query . '%')
                  ->orWhere('penerbit', 'like', '%' . $query . '%');
            });
        }
        
        if (!empty($kategori)) {
            $booksQuery->whereHas('category', function($q) use ($kategori) {
                $q->where('name', $kategori);
            });
        }
        
        $books = $booksQuery->latest()->paginate(12, ['*'], 'page', $page);
        
        if ($books->isEmpty()) {
            return '';
        }
        
        return view('partials.book-cards', compact('books'))->render();
    }
}