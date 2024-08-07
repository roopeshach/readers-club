<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category', 'user');

        // Handle search
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhereHas('category', function($q) use ($search) {
                      $q->where('name', 'LIKE', "%{$search}%");
                  });
        }

        // Handle category filter
        if ($request->has('category')) {
            $categoryId = $request->input('category');
            $query->where('category_id', $categoryId);
        }

        $books = $query->paginate(5); // Paginate the results
        $categories = Category::all(); // Fetch all categories for filtering

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Book::class);
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Book::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'edition' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'cover_art' => 'nullable|image',
        ]);

        $book = new Book($request->all());
        $book->user_id = Auth::id();
        
        if ($request->hasFile('cover_art')) {
            $book->cover_art = $request->file('cover_art')->store('covers');
        }
        
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        // if not authenticated redirect home
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        // Increment the views count
        $book->incrementViews();

        // Retrieve the updated view count
        $views = $book->views;

        return view('books.show', compact('book', 'views'));
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);

        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);

        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'edition' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'cover_art' => 'nullable|image',
        ]);

        $book->update($request->all());
        
        if ($request->hasFile('cover_art')) {
            $book->cover_art = $request->file('cover_art')->store('covers');
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
