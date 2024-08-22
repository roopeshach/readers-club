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
            'comment_content' => 'required|string',
        ]);

        Comment::create([
            'book_id' => $book->id,
            'comment_user_id' => Auth::id(),
            'comment_content' => $request->comment_content,
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Comment added successfully.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
