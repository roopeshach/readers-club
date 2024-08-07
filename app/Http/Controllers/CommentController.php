<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = new Comment($request->all());
        $comment->user_id = Auth::id();
        $comment->book_id = $book->id;
        $comment->save();

        return redirect()->route('books.show', $book->id)->with('success', 'Comment added successfully.');
    }

    public function destroy(Book $book, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('books.show', $book->id)->with('success', 'Comment deleted successfully.');
    }
}
