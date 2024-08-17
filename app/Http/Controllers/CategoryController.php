<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all categories
        $categories = Category::all();

        // Return the index view with the categories
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'genre_name' => 'required|string|max:255|unique:categories',
        ]);

        // Create a new category
        Category::create($request->only('genre_name'));

        // Flash a success message to the session
        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }
}
