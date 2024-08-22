<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author', 'category')->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = BookCategory::all();
        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required|string|max:255',
            'book_code' => 'required|string|unique:books',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:book_categories,id',
            'cover_image_path' => 'nullable|string|max:255', // Image URL validation
        ]);

        Book::create([
            'book_title' => $request->book_title,
            'book_code' => $request->book_code,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'owner_id' => Auth::id(),
            'cover_image_path' => $request->cover_image_path,
            'views_count' => 0,
        ]);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = BookCategory::all();
        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_title' => 'required|string|max:255',
            'book_code' => 'required|string|unique:books,book_code,' . $book->id,
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:book_categories,id',
            'cover_image_path' => 'nullable|string|max:255', // Image URL validation
        ]);

        $book->update([
            'book_title' => $request->book_title,
            'book_code' => $request->book_code,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'cover_image_path' => $request->cover_image_path,
        ]);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
