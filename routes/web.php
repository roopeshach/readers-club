<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Public Routes
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Auth::routes();

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('books', BookController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('authors', AuthorController::class)->except(['show']);
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
Route::post('/books/{book}/reviews', [BookController::class, 'storeReview'])->name('books.reviews.store');
Route::delete('/books/{book}/reviews/{review}', [BookController::class, 'destroyReview'])->name('books.reviews.destroy');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('authors/{author}', [AuthorController::class, 'show'])->name('authors.show');

// Authentication Routes
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
