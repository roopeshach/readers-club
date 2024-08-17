@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $book->title }}</h1>

    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset($book->cover_art) }}" class="img-fluid" alt="{{ $book->title }}">
        </div>
        <div class="col-md-8">
            <h4>Book Details</h4>
            <p><strong>Author:</strong> {{ $book->author->name }}</p>
            <p><strong>Category:</strong> {{ $book->category->name }}</p>
            <p><strong>Publisher:</strong> {{ $book->publisher }}</p>
            <p><strong>Edition:</strong> {{ $book->edition }}</p>
            <p><strong>ISBN:</strong> {{ $book->isbn }}</p>
            <p><strong>Views:</strong> {{ $book->views }}</p>
            <p><strong>Description:</strong> {{ $book->description }}</p>
            <p><strong>Published Year:</strong> {{ $book->published_year }}</p>

            @auth
    @if(Auth::user()->isSuperAdmin() || Auth::user()->id === $book->user_id)
        <div class="mt-4">
            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    @endif
@endauth

            <!-- Add Review Form -->
            @auth
                <h5>Add Your Review</h5>
                <form action="{{ route('books.reviews.store', $book->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="content" class="form-control" placeholder="Write your review here..." rows="3" required></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="rating">Rating:</label>
                        <select name="rating" class="form-control w-25" required>
                            <option value="1">1 - Poor</option>
                            <option value="2">2 - Fair</option>
                            <option value="3">3 - Good</option>
                            <option value="4">4 - Very Good</option>
                            <option value="5">5 - Excellent</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit Review</button>
                </form>
            @endauth

            <!-- Reviews Section -->
            <h5 class="mt-5">Reviews</h5>
            @if($book->reviews->count() > 0)
                <ul class="list-group">
                    @foreach ($book->reviews as $review)
                        <li class="list-group-item">
                            <p>{{ $review->content }} - <strong>{{ $review->user->name }}</strong> (Rating: {{ $review->rating }}/5)</p>
                            @if($review->user_id == Auth::id())
                                <form action="{{ route('books.reviews.destroy', [$book->id, $review->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No reviews yet.</p>
            @endif
        </div>
    </div>

    <!-- Related Books in the Same Category -->
    <h3 class="mt-5">Related Books</h3>
    <div class="row">
        @foreach ($categoryBooks as $relatedBook)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset($relatedBook->cover_art) }}" class="card-img-top" alt="{{ $relatedBook->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $relatedBook->title }}</h5>
                        <p class="card-text">
                            <strong>Author:</strong> {{ $relatedBook->author->name }}<br>
                            <strong>Views:</strong> {{ $relatedBook->views }}
                        </p>
                        <a href="{{ route('books.show', $relatedBook->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links for Related Books -->
    <div class="d-flex justify-content-center">
        {{ $categoryBooks->links() }}
    </div>
</div>
@endsection
