<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Auth::routes();

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Home route
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Book routes
    Route::resource('books', BookController::class)->except(['show']);
    Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');

    // Comment routes
    Route::post('books/{book}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('books/{book}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Category routes
    Route::resource('categories', CategoryController::class)->except(['show']);
});

// Public routes
Route::get('/', [BookController::class, 'index'])->name('welcome');

Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');


// Authentication Routes
require __DIR__.'/auth.php';
