<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return redirect()->route('books.index');
})->name('home');

// Book routes
Route::middleware(['auth'])->group(function () {
    Route::resource('books', BookController::class);

    // Comment routes - Nested under books
    Route::post('books/{book}/comments', [CommentController::class, 'store'])->name('comments.store');
    
    // BookCategory routes
    Route::resource('book_categories', BookCategoryController::class)->except(['show']);
    
    // Publisher routes
    Route::resource('publishers', PublisherController::class)->except(['show']);

    Route::delete('/books/{book}/comments/{comment}', [BookController::class, 'destroyComment'])->name('comments.destroy');

});

// Authentication routes (optional if you are using Laravel Breeze or any other package)
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
