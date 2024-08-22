<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function index() {
        $categories = BookCategory::paginate(10);
        return view('book_categories.index', compact('categories'));
    }

    public function create() {
        return view('book_categories.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'category_name' => 'required|unique:book_categories',
        ]);

        BookCategory::create($data);

        return redirect()->route('book_categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(BookCategory $bookCategory) {
        return view('book_categories.edit', compact('bookCategory'));
    }

    public function update(Request $request, BookCategory $bookCategory) {
        $data = $request->validate([
            'category_name' => 'required|unique:book_categories,category_name,' . $bookCategory->id,
        ]);

        $bookCategory->update($data);

        return redirect()->route('book_categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(BookCategory $bookCategory) {
        $bookCategory->delete();

        return redirect()->route('book_categories.index')->with('success', 'Category deleted successfully.');
    }
}
