<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReactController;





// use auth
use Illuminate\Support\Facades\Auth;


// Home route, redirecting to the welcome page
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Routes for Books
Route::resource('books', BookController::class);

// Routes for Book Categories
Route::resource('book_categories', BookCategoryController::class);

// Routes for Authors
Route::resource('authors', AuthorController::class);

// Routes for Comments (Handled as part of the books show page)
Route::post('books/{book}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Routes for Reacts (Handled as part of the books show page)
Route::post('books/{book}/reacts', [ReactController::class, 'store'])->name('reacts.store');
Route::delete('reacts/{react}', [ReactController::class, 'destroy'])->name('reacts.destroy');

// Auth routes
Auth::routes();