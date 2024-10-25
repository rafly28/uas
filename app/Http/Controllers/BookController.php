<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Menampilkan form untuk membuat buku baru
    public function create()
    {
        return view('books.create');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|digits:4',
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan detail buku
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Menampilkan form untuk mengedit buku
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // Memperbarui buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|digits:4',
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
