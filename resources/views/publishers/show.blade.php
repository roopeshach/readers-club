@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold mb-4">{{ $book->book_name }}</h1>
        <img class="h-60 w-full object-cover rounded-lg mb-4" src="{{ asset($book->image_path) }}" alt="{{ $book->book_name }}">
        <p class="text-gray-500 mb-2">By {{ $book->published_by }}</p>
        <p class="text-gray-500 mb-2">Category: {{ $book->genre->genre_name }}</p>
        <p class="text-gray-500 mb-2">Edition: {{ $book->release_version }}</p>
        <p class="text-gray-500 mb-2">Views: {{ $book->view_count }}</p>

        <div class="mt-4">
            @can('update', $book)
                <a href="{{ route('books.edit', $book->id) }}" class="text-yellow-500 hover:underline">Edit</a>
            @endcan
            @can('delete', $book)
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                </form>
            @endcan
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg mt-6">
        <h2 class="text-xl font-semibold mb-4">Comments</h2>

        @forelse($book->comments as $comment)
            <div class="mb-4">
                <p class="text-gray-700">{{ $comment->comment_text }}</p>
                <p class="text-gray-500 text-sm">By {{ $comment->commenter->name }} on {{ $comment->created_at->format('M d, Y') }}</p>
                @can('delete', $comment)
                    <form action="{{ route('comments.destroy', [$book->id, $comment->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline mt-2">Delete</button>
                    </form>
                @endcan
            </div>
        @empty
            <p class="text-gray-500">No comments yet.</p>
        @endforelse

        @auth
            <form action="{{ route('comments.store', $book->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="comment_text" class="block text-gray-700">Add a comment:</label>
                    <textarea name="comment_text" id="comment_text" rows="3" class="form-input mt-1 block w-full"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
            </form>
        @endauth
    </div>
</div>
@endsection
