<!-- resources/views/books/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-purple-400 mb-6">Add New Book</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="book_title" class="block text-gray-300">Book Title</label>
            <input type="text" name="book_title" id="book_title" class="w-full p-2 rounded bg-gray-900 text-gray-100" value="{{ old('book_title') }}" required>
        </div>

        <div class="mb-4">
            <label for="book_code" class="block text-gray-300">Book Code</label>
            <input type="text" name="book_code" id="book_code" class="w-full p-2 rounded bg-gray-900 text-gray-100" value="{{ old('book_code') }}" required>
        </div>

        <div class="mb-4">
            <label for="author_id" class="block text-gray-300">Author</label>
            <select name="author_id" id="author_id" class="w-full p-2 rounded bg-gray-900 text-gray-100">
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-300">Category</label>
            <select name="category_id" id="category_id" class="w-full p-2 rounded bg-gray-900 text-gray-100">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="cover_image_path" class="block text-gray-300">Cover Image URL</label>
            <input type="text" name="cover_image_path" id="cover_image_path" class="w-full p-2 rounded bg-gray-900 text-gray-100" value="{{ old('cover_image_path') }}">
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Save Book</button>
        </div>
    </form>
</div>
@endsection
