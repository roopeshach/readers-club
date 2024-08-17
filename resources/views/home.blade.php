@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="container">
        <div class="jumbotron text-center bg-light p-5 rounded">
            <h1 class="display-4">Welcome to Book Readers Club</h1>
            <p class="lead">Discover a vast collection of books and join a community of readers.</p>
            @guest
                <p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Register</a>
                </p>
            @else
                <p class="lead">Welcome back, {{ Auth::user()->name }}!</p>
                <a href="{{ route('home') }}" class="btn btn-success btn-lg">Go to Books</a>
            @endguest
        </div>

        <div class="row mt-5">
            <div class="col-md-8">
                <h2 class="mb-4">Available Books</h2>
                <div class="list-group">
                    @forelse ($books as $book)
                        <a href="{{ route('books.show', $book->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $book->title }}</h5>
                            </div>
                            <p class="mb-1">Author: {{ $book->category }}</p>
                        </a>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            No books available.
                        </div>
                    @endforelse
                </div>
            </div>

            <div class="col-md-4">
                <h2 class="mb-4">Categories</h2>
                <div class="list-group">
                    @forelse ($categories as $category)
                        <a href="{{ route('categories.show', $category->id) }}" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $category->name }}</h5>
                                <small class="text-muted">Books: {{ $category->books_count }}</small>
                            </div>
                        </a>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            No categories available.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
