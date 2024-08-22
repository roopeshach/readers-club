<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCategory;

use App\Models\Comment;
use App\Models\Publisher;
use Illuminate\Http\Request;


class BookController extends Controller
{
    public function index() {
        $books = Book::all();
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
        ]);

        $data['owner_id'] = auth()->id();

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
        ]);

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book) {
        
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }

    public function destroyComment(Book $book, Comment $comment) {
        // Ensure that the comment belongs to the book and the user has permission
        if ($comment->book_id == $book->id && auth()->user()->can('delete', $comment)) {
            $comment->delete();
            return redirect()->route('books.show', $book->id)->with('success', 'Comment deleted successfully.');
        }

        return redirect()->route('books.show', $book->id)->with('error', 'You are not authorized to delete this comment.');
    }
}
