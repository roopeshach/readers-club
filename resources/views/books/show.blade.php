@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h1 class="card-title">{{ $book->book_title }}</h1>
                </div>
                <div class="card-body">
                    <p><strong>Code:</strong> {{ $book->book_code }}</p>
                    <p><strong>Category:</strong> {{ $book->category->category_name }}</p>
                    <p><strong>Publisher:</strong> {{ $book->publisher->publisher_name }}</p>
                    <p><strong>Owner:</strong> {{ $book->owner->name }}</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h3 class="card-title">Comments</h3>
                </div>
                <div class="card-body">
                    @foreach($book->comments as $comment)
                        <div class="media mb-3">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $comment->user->username }}</h5>
                                <p>{{ $comment->comment_content }}</p>
                                <small class="text-muted">{{ $comment->created_at->format('d M Y') }}</small>
                                
                                @can('delete', $comment)
                                    <form action="{{ route('comments.destroy', [$book->id, $comment->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm mt-2"
                                            onclick="return confirm('Are you sure you want to delete this comment?');">
                                            Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>

            @auth
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="card-title">Add a Comment</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('comments.store', $book->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="comment_content">Comment</label>
                                <textarea class="form-control" id="comment_content" name="comment_content" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Submit Comment</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection
