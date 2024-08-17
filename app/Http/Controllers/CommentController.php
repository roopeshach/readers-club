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
            'comment_text' => 'required|string|max:1000',
        ]);

        Comment::create([
            'book_reference' => $book->id,
            'commenter_id' => Auth::id(),
            'comment_text' => $request->comment_text,
        ]);

        return redirect()->route('books.show', $book->id)->with('success', 'Comment added successfully.');
    }

    public function destroy(Book $book, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        return redirect()->route('books.show', $book->id)->with('success', 'Comment deleted successfully.');
    }
}
