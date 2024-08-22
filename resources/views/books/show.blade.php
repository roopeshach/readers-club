<!-- resources/views/books/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-purple-400 mb-6">{{ $book->book_title }}</h2>

    <div class="mb-4">
        <img src="{{ $book->cover_image_path }}" alt="Cover Image" class="w-full max-w-xs rounded-lg shadow-lg mb-4">
    </div>

    <p class="mb-4"><strong>Author:</strong> {{ $book->author->author_name }}</p>
    <p class="mb-4"><strong>Category:</strong> {{ $book->category->category_name }}</p>
    <p class="mb-4"><strong>Views:</strong> {{ $book->views_count }}</p>

    <!-- Reacts Section -->
    <div class="mt-6">
        <h3 class="text-2xl font-semibold text-purple-400 mb-4">Reactions</h3>
        
        @auth

        <div class="flex space-x-4 mb-4">
            @foreach (['like', 'angry', 'sad', 'happy', 'love'] as $reaction)
                <form action="{{ route('reacts.store', $book) }}" method="POST">
                    @csrf
                    <input type="hidden" name="reaction_type" value="{{ $reaction }}">
                    <button type="submit" class="bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">{{ ucfirst($reaction) }}</button>
                </form>
            @endforeach
        </div>
        @endauth

        <div class="space-y-2">
            @foreach ($book->reacts as $react)
                <div class="bg-gray-700 p-2 rounded-lg inline-block">
                    <span class="font-bold">{{ $react->user->name }}:</span> {{ ucfirst($react->reaction_type) }}
                    <br>
                    @can ('delete', $react)
                    <form action="{{ route('reacts.destroy', $react) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Remove</button>
                    </form>
                    @endauth
                </div>
            @endforeach
        </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-6">
        <h3 class="text-2xl font-semibold text-purple-400 mb-4">Comments</h3>

        @foreach ($book->comments as $comment)
            <div class="bg-gray-700 p-4 rounded-lg mb-4">
                <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment_content }}</p>
                @can ('delete', $comment)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                </form>
                @endcan
            </div>
        @endforeach

        <div class="mt-6">
            <h4 class="text-xl font-semibold text-purple-400 mb-4">Add a Comment</h4>
            <form action="{{ route('comments.store', $book) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <textarea name="comment_content" id="comment_content" class="w-full p-2 rounded bg-gray-900 text-gray-100" rows="4" required>

                    @guest
                    You must be logged in to comment.
                    @endguest

                    </textarea>
                </div>
                <div>
                    
                    @auth
                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded"> Submit</button>
                    @endauth
                    @guest
                    <button type="text" disabled class="bg-gray-600 text-white font-bold py-2 px-4 rounded">Login to Comment</button>
                    @endguest
                    
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('books.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back to Books</a>
    </div>
</div>
@endsection
