@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $book->book_title }}</h1>
    <p><strong>Code:</strong> {{ $book->book_code }}</p>
    <p><strong>Category:</strong> {{ $book->category->category_name }}</p>
    <p><strong>Publisher:</strong> {{ $book->publisher->publisher_name }}</p>
    <p><strong>Owner:</strong> {{ $book->owner->username }}</p>
    @if($book->cover_image_path)
    <img src="{{ asset('storage/'.$book->cover_image_path) }}" alt="Cover Image" class="img-thumbnail mt-2" width="150">
    @endif

    <h3 class="mt-4">Comments</h3>
    @foreach($book->comments as $comment)
    <div class="card mt-2">
        <div class="card-body">
            <p>{{ $comment->comment_content }}</p>
            <small>By {{ $comment->user->username }} on {{ $comment->created_at->format('d M Y') }}</small>
        </div>
    </div>
    @endforeach

    @auth
    <form action="{{ route('comments.store', $book->id) }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group">
            <label for="comment_content">Add Comment</label>
            <textarea class="form-control" id="comment_content" name="comment_content" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
    @endauth
</div>
@endsection
