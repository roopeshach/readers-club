@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h1>Welcome to Book Readers Club</h1>
            @guest
                <p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Register</a>
                </p>
            @else
                <p>Welcome back, {{ Auth::user()->name }}!</p>
                <a href="{{ route('home') }}" class="btn btn-success btn-lg">Go to Books</a>
            @endguest
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <h2>Available Books</h2>
                <ul class="list-group">
                    @forelse ($books as $book)
                        <li class="list-group-item">
                            <h5>{{ $book->title }}</h5>
                            <p>{{ $book->author->name }}</p>
                            <p> <strong>Category:</strong> {{ $book->category->name }}</p>
                            <p><strong>Views:</strong> {{ $book->views }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">View Details</a>
                        </li>
                    @empty
                        <li class="list-group-item">No books available.</li>
                    @endforelse
                </ul>
            </div>

            <div class="col-md-4">
                <h2>Categories</h2>
                <ul class="list-group">
                    @forelse ($categories as $category)
                        <li class="list-group-item">
                            <h5>{{ $category->name }}</h5>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info">View Books</a>
                        </li>
                    @empty
                        <li class="list-group-item">No categories available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
