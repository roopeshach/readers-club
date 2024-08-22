<?php

namespace App\Http\Controllers;

use App\Models\React;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactController extends Controller
{
    public function store(Request $request, Book $book)
    {
        $request->validate([
            'reaction_type' => 'required|in:like,angry,sad,happy,love',
        ]);

        React::create([
            'book_id' => $book->id,
            'react_user_id' => Auth::id(),
            'reaction_type' => $request->reaction_type,
        ]);

        return redirect()->route('books.show', $book)->with('success', 'Reaction added successfully.');
    }

    public function destroy(React $react)
    {
        $this->authorize('delete', $react);

        $react->delete();
        return redirect()->back()->with('success', 'Reaction removed successfully.');
    }
}
