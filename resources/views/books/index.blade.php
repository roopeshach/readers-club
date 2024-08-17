@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Books</h1>
    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($book->cover_art) }}" class="card-img-top" alt="{{ $book->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">
                            <strong>Author:</strong> {{ $book->author->name }}<br>
                            <strong>Category:</strong> {{ $book->category->name }}<br>
                            <strong>Views:</strong> {{ $book->views }}
                        </p>
                        <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
</div>
@endsection
