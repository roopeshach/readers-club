<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::paginate(10);
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_bio' => 'nullable|string',
        ]);

        Author::create([
            'author_name' => $request->author_name,
            'author_bio' => $request->author_bio,
        ]);

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_bio' => 'nullable|string',
        ]);

        $author->update([
            'author_name' => $request->author_name,
            'author_bio' => $request->author_bio,
        ]);

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
