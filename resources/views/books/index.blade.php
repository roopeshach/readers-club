@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Books</h1>

    @can('create', App\Models\Book::class)
        <div class="mb-3">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>
    @endcan

    <div class="row">
        @foreach($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($book->cover_art) }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">By {{ $book->author->name }}</p>
                        <p class="card-text">Category: {{ $book->category->name }}</p>
                        <p class="card-text">Views: {{ $book->views }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary">View Details</a>
                        
                        @can('update', $book)
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning ms-2">Edit</a>
                        @endcan

                        @can('delete', $book)
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
