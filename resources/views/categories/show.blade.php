@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Category: {{ $category->genre_name }}</h1>
    <div class="row">
        @forelse($category->books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($book->image_path) }}" class="card-img-top" alt="{{ $book->book_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->book_name }}</h5>
                        <p class="card-text">By {{ $book->published_by }}</p>
                        <p class="card-text">Edition: {{ $book->release_version }}</p>
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
        @empty
            <p>No books found in this category.</p>
        @endforelse
    </div>
</div>
@endsection
