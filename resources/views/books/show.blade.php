@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-primary">{{ $book->title }}</h1>
            <div class="row">
                <div class="col">
                    <img src="{{ asset($book->cover_art) }}" alt="{{ $book->title }}" class="img-fluid mb-3">
                </div>
                <div class="col mt-5">
                    <p><strong>Author:</strong> {{ $book->author }}</p>
                    <p><strong>Publisher:</strong> {{ $book->publisher->name }}</p>
                    <p><strong>Edition:</strong> {{ $book->edition }}</p>
                    <p><strong>Category:</strong> {{ $book->category->name }}</p>
                    <p><strong>Added by:</strong> {{ $book->user->name }}</p>
                    <p><strong>Views:</strong> {{ $book->views }}</p> <!-- Directly use $book->views -->
                </div>
            </div>

            <h2>Comments</h2>
            @foreach ($book->comments as $comment)
                <div class="card mb-2">
                    <div class="card-body">
                        <p>{{ $comment->content }}</p>
                        <p><small>By {{ $comment->user->name }}</small></p>
                        @if (Auth::id() == $comment->user_id || Auth::user()->role == 'admin')
                            <form action="{{ route('comments.destroy', [$book->id, $comment->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

            @auth
                <form action="{{ route('comments.store', $book->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Add a comment</label>
                        <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning">Add Comment</button>
                </form>
            @endauth
        </div>
    </div>
</div>
@endsection
