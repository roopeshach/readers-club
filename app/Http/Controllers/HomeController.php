<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        // Fetch all books (or you can apply filters if needed)
        $books = Book::all();
        $categories = Category::all();
        
        // Pass the books to the welcome view
        return view('home', compact('books', 'categories'));
    }

    public function welcome()
    {
        // Fetch all books (or you can apply filters if needed)
        $books = Book::all();
        $categories = Category::all();
        
        // Pass the books to the welcome view
        return view('welcome', compact('books', 'categories'));
    }
}
