<!-- resources/views/authors/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-purple-400 mb-6">Edit Author</h2>

    <form action="{{ route('authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="author_name" class="block text-gray-300">Author Name</label>
            <input type="text" name="author_name" id="author_name" class="w-full p-2 rounded bg-gray-900 text-gray-100" value="{{ $author->author_name }}" required>
        </div>

        <div class="mb-4">
            <label for="author_bio" class="block text-gray-300">Author Bio</label>
            <textarea name="author_bio" id="author_bio" class="w-full p-2 rounded bg-gray-900 text-gray-100" rows="4">{{ $author->author_bio }}</textarea>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Update Author</button>
        </div>
    </form>
</div>
@endsection
