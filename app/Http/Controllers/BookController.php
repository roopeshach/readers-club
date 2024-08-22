<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        // Fetch all books with their related category, owner, and publisher
        $books = Book::with(['genre', 'owner', 'publisher'])->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        // Fetch all categories and publishers for the dropdowns in the create form
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('books.create', compact('categories', 'publishers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_name' => 'required|string|max:255',
            'book_code' => 'required|string|max:13|unique:books,book_code',
            'publisher_id' => 'required|exists:publishers,id',
            'release_version' => 'required|integer',
            'genre_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $book = new Book($request->all());
        $book->owner_id = Auth::id();

        if ($request->hasFile('image_path')) {
            $book->image_path = $request->file('image_path')->store('covers');
        }

        $book->save();

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    public function show(Book $book)
    {
        $book->incrementViews();
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $publishers = Publisher::all();
        return view('books.edit', compact('book', 'categories', 'publishers'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_name' => 'required|string|max:255',
            'book_code' => 'required|string|max:13|unique:books,book_code,' . $book->id,
            'publisher_id' => 'required|exists:publishers,id',
            'release_version' => 'required|integer',
            'genre_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|max:2048',
        ]);

        $book->update($request->all());

        if ($request->hasFile('image_path')) {
            $book->image_path = $request->file('image_path')->store('covers');
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
