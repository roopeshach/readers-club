<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);

    Route::post('books/{book}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('books/{book}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


//for guest users
Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');
