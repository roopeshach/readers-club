<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher; 
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

        $books = $query->paginate(10); // Paginate the results
        $categories = Category::all(); // Fetch all categories for filtering

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $this->authorize('create', Book::class);
        $categories = Category::all();
        $publishers = Publisher::all(); // Fetch all publishers
        return view('books.create', compact('categories', 'publishers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books',
            'author' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
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
    
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'author' => 'required|string|max:255',
            'publisher_id' => 'required|exists:publishers,id',
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
    public function show(Book $book)
    {
        $book->incrementViews();
        return view('books.show', compact('book'));
    }


    public function edit(Book $book)
    {
        // Authorize the action
        $this->authorize('update', $book);

        // Get all categories and publishers
        $categories = Category::all();
        $publishers = Publisher::all(); 

        // Return the edit view with the book, categories, and publishers
        return view('books.edit', compact('book', 'categories', 'publishers'));
    }

}
