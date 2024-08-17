@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-6">Add New Book</h1>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="book_name" class="block text-gray-700">Book Name:</label>
                <input type="text" name="book_name" id="book_name" class="form-input mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="book_code" class="block text-gray-700">ISBN:</label>
                <input type="text" name="book_code" id="book_code" class="form-input mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="published_by" class="block text-gray-700">Publisher:</label>
                <input type="text" name="published_by" id="published_by" class="form-input mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="release_version" class="block text-gray-700">Edition:</label>
                <input type="text" name="release_version" id="release_version" class="form-input mt-1 block w-full" required>
            </div>
            <div class="mb-4">
                <label for="genre_id" class="block text-gray-700">Category:</label>
                <select name="genre_id" id="genre_id" class="form-select mt-1 block w-full">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->genre_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="image_path" class="block text-gray-700">Cover Image:</label>
                <input type="file" name="image_path" id="image_path" class="form-input mt-1 block w-full">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add Book</button>
        </form>
    </div>
</div>
@endsection
