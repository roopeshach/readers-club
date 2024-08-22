<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function index()
    {
        $categories = BookCategory::paginate(10);
        return view('book_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('book_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:book_categories',
        ]);

        BookCategory::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('book_categories.index')->with('success', 'Category created successfully.');
    }

    public function edit(BookCategory $category)
    {
        return view('book_categories.edit', compact('category'));
    }

    public function update(Request $request, BookCategory $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:book_categories,category_name,' . $category->id,
        ]);

        $category->update([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('book_categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BookCategory $category)
    {
        $category->delete();
        return redirect()->route('book_categories.index')->with('success', 'Category deleted successfully.');
    }
}
