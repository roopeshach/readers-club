<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Fetch books with their related author and category, paginating the results
        $books = Book::with('author', 'category')->paginate(9); // Display 9 books per page
        return view('books.index', compact('books'));
    }

    public function create()
    {
        // Fetch all authors and categories for the dropdowns in the create form
        $authors = Author::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'cover_art' => 'nullable|image|max:2048' // Validate image size
        ]);

        // Handle the cover art file upload if present
        $data = $request->all();
        if ($request->hasFile('cover_art')) {
            $data['cover_art'] = $request->file('cover_art')->store('covers');
        }

        // Create a new book record
        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function show(Book $book)
    {
        // Increment the views count
        $book->incrementViews();

        // Fetch books in the same category, excluding the current book
        $categoryBooks = Book::where('category_id', $book->category_id)
                            ->where('id', '!=', $book->id)
                            ->paginate(6); // Show 6 related books

        

        return view('books.show', compact('book', 'categoryBooks'));
    }

    public function edit(Book $book)
    {
        // Fetch all authors and categories for the dropdowns in the edit form
        $authors = Author::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|max:13|unique:books,isbn,' . $book->id,
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'published_year' => 'nullable|integer',
            'cover_art' => 'nullable|image|max:2048' // Validate image size
        ]);

        // Handle the cover art file upload if present
        $data = $request->all();
        if ($request->hasFile('cover_art')) {
            $data['cover_art'] = $request->file('cover_art')->store('covers');
        }

        // Update the existing book record
        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        // Delete the book record
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function storeReview(Request $request, Book $book)
    {
        // Validate the review
        $request->validate([
            'content' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Create the review
        $review = new Review([
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
            'user_id' => Auth::id(),
        ]);

        $book->reviews()->save($review);

        return redirect()->route('books.show', $book->id)->with('success', 'Review added successfully.');
    }

    public function destroyReview(Book $book, Review $review)
    {
        // Ensure the user is authorized to delete the review
        if ($review->user_id !== Auth::id()) {
            return redirect()->route('books.show', $book->id)->with('error', 'You are not authorized to delete this review.');
        }

        $review->delete();

        return redirect()->route('books.show', $book->id)->with('success', 'Review deleted successfully.');
    }
}
