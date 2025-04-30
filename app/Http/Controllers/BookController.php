<?php
namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Book;
    use App\Models\Category; 
    use App\Models\Peminjaman; // PERBAIKAN: Pastikan P kapital

    class BookController extends Controller
    {
        // Menampilkan semua buku
        public function index()
        {
            $books = Book::all();
            $categories = Category::all(); // TAMBAHAN: untuk konsistensi
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();

            return view('buku', compact('books', 'categories', 'peminjamans'));
        }
        
        public function filterKategoriuser($kategori)
        {
            $categories = Category::all();
            $books = Book::whereHas('category', function($query) use ($kategori) {
                $query->where('name', $kategori);
            })->get();

            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
            
            return view('buku', compact('books', 'categories', 'peminjamans'));
        }

        public function filterKategori(Request $request)
        {
            $kategoriId = $request->kategori;
            $categories = Category::all();
            $books = Book::where('category_id', $kategoriId)->get();
            
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        
            return view('DashboardAdmin', compact('books', 'categories', 'peminjamans'));
        }

        public function search(Request $request)
        {
            $keyword = $request->keyword;
            $categories = Category::all();
            
            // Pencarian yang ditingkatkan untuk mencari berdasarkan beberapa kolom
            $books = Book::where('judul', 'like', "%$keyword%")
                         ->orWhere('penulis', 'like', "%$keyword%")
                         ->orWhere('penerbit', 'like', "%$keyword%")
                         ->orWhere('tahun_terbit', 'like', "%$keyword%")
                         ->get();
            
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
        
            return view('DashboardAdmin', compact('books', 'categories', 'peminjamans'));
        }

        // Menampilkan halaman dashboard admin
        public function dashboard()
        {
            $books = Book::all();
            $categories = Category::all();
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
            
            return view('DashboardAdmin', compact('books', 'categories', 'peminjamans'));
        }
        
        // Menampilkan form tambah buku
        public function create()
        {
            $categories = Category::all(); 
            // TAMBAHAN: Jika view books.create membutuhkan $peminjamans
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
            
            return view('books.create', compact('categories', 'peminjamans'));
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
                'category_id' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            
            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('books', 'public');
            }
            
            Book::create($validated);
            
            // Mengubah redirect ke dashboard admin
            return redirect()->route('dashboard.admin')->with('success', 'Buku berhasil ditambahkan.');
        }
        
        // Menampilkan form edit buku
        public function edit(Book $book)
        {
            $categories = Category::all();
            // TAMBAHAN: Jika view editbuku membutuhkan $peminjamans
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
            
            return view('editbuku', compact('book', 'categories', 'peminjamans'));
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
                'category_id' => 'required',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
            
            if ($request->hasFile('foto')) {
                if ($book->foto) {
                    \Illuminate\Support\Facades\Storage::delete('public/' . $book->foto);
                }
                
                $validated['foto'] = $request->file('foto')->store('books', 'public');
            }
            
            $book->update($validated);
            
            // Mengubah redirect ke dashboard admin
            return redirect()->route('DashboardAdmin')->with('success', 'Buku berhasil diperbarui.');
        }
        
        // Menghapus buku
        public function destroy(Book $book)
        {
            if ($book->foto) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $book->foto);
            }
            
            $book->delete();
            // Mengubah redirect ke dashboard admin
            return redirect()->route('DashboardAdmin')->with('success', 'Buku berhasil dihapus.');
        }

        public function formPinjam($id)
        {
            $book = Book::findOrFail($id);
            // TAMBAHAN: Jika view peminjaman.form membutuhkan $peminjamans
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
            
            return view('peminjaman.form', compact('book', 'peminjamans'));
        }

        public function pinjam(Request $request)
        {
            // Logic to process the book loan
            // ...
            
            // Ini sudah benar, tetap mengarah ke dashboard user
            return redirect()->route('dashboard.user')->with('success', 'Buku berhasil dipinjam');
        }

        public function show($id)
        {
            $book = Book::findOrFail($id);
            // TAMBAHAN: Jika view showbuku membutuhkan $peminjamans
            $peminjamans = Peminjaman::where('status', 'dipinjam')->get();
            
            return view('showbuku', compact('book', 'peminjamans'));
        }
    }