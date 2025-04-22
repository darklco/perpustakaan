<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $kategori = Category::all();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Category $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
