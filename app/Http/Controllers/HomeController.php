<?php


namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $membersCount = User::count();
        $mostViewedBooks = Book::orderBy('views', 'desc')->take(6)->get();

        return view('home', compact('bookCount', 'categoryCount', 'mostViewedBooks', 'membersCount'));
    }
}
