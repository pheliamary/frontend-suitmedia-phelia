<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::latest()->get();
        return view('books.book', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|max:100',
            'stok' => 'required|integer|min:0',
            'penerbit' => 'nullable|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('cover')) {
            $filename = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->storeAs('public/covers', $filename);
            $validated['cover'] = $filename;
        }

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.detail', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'penulis' => 'required|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|max:100',
            'stok' => 'required|integer|min:0',
            'penerbit' => 'nullable|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle file upload
        if ($request->hasFile('cover')) {
            // Delete old cover if exists
            if ($book->cover && Storage::exists('public/covers/' . $book->cover)) {
                Storage::delete('public/covers/' . $book->cover);
            }
            
            $filename = time() . '_' . $request->file('cover')->getClientOriginalName();
            $request->file('cover')->storeAs('public/covers', $filename);
            $validated['cover'] = $filename;
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Delete cover file if exists
        if ($book->cover && Storage::exists('public/covers/' . $book->cover)) {
            Storage::delete('public/covers/' . $book->cover);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }

    /**
     * Search books
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $books = Book::where('judul', 'LIKE', "%{$query}%")
                    ->orWhere('penulis', 'LIKE', "%{$query}%")
                    ->orWhere('kategori', 'LIKE', "%{$query}%")
                    ->latest()
                    ->get();

        return response()->json($books);
    }
}