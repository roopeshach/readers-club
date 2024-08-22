<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Book;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $bookId) {
        $data = $request->validate([
            'comment_content' => 'required',
        ]);

        $data['book_id'] = $bookId;
        $data['comment_user_id'] = auth()->id();

        Comment::create($data);

        return redirect()->route('books.show', $bookId)->with('success', 'Comment added successfully.');
    }

    public function edit(Comment $comment) {
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment) {
        $data = $request->validate([
            'comment_content' => 'required',
        ]);

        $comment->update($data);

        return redirect()->route('books.show', $comment->book_id)->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment) {
        $comment->delete();

        return redirect()->route('books.show', $comment->book_id)->with('success', 'Comment deleted successfully.');
    }
}
