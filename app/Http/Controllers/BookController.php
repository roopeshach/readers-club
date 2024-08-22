<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $books = Book::with(['category', 'publisher', 'owner'])->paginate(10);
        return view('books.index', compact('books'));
    }

    public function create() {
        $categories = BookCategory::all();
        $publishers = Publisher::all();
        return view('books.create', compact('categories', 'publishers'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'book_title' => 'required',
            'book_code' => 'required|unique:books',
            'publisher_id' => 'required',
            'category_id' => 'required',
            'cover_image_path' => 'nullable|image',
        ]);

        $data['owner_id'] = auth()->id();

        if ($request->hasFile('cover_image_path')) {
            $data['cover_image_path'] = $request->file('cover_image_path')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function show(Book $book) {
        $book->load(['category', 'publisher', 'owner', 'comments.user']);
        return view('books.show', compact('book'));
    }

    public function edit(Book $book) {
        $categories = BookCategory::all();
        $publishers = Publisher::all();
        return view('books.edit', compact('book', 'categories', 'publishers'));
    }

    public function update(Request $request, Book $book) {
        $data = $request->validate([
            'book_title' => 'required',
            'book_code' => 'required|unique:books,book_code,' . $book->id,
            'publisher_id' => 'required',
            'category_id' => 'required',
            'cover_image_path' => 'nullable|image',
        ]);

        if ($request->hasFile('cover_image_path')) {
            $data['cover_image_path'] = $request->file('cover_image_path')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book) {
        if ($book->cover_image_path) {
            \Storage::disk('public')->delete($book->cover_image_path);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
