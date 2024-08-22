@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Book</h1>
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="book_name" class="form-label">Book Name</label>
            <input type="text" name="book_name" id="book_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="book_code" class="form-label">Book Code (ISBN)</label>
            <input type="text" name="book_code" id="book_code" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="publisher_id" class="form-label">Publisher</label>
            <select name="publisher_id" id="publisher_id" class="form-control" required>
                @foreach($publishers as $publisher)
                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="release_version" class="form-label">Edition</label>
            <input type="number" name="release_version" id="release_version" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="genre_id" class="form-label">Category</label>
            <select name="genre_id" id="genre_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->genre_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="image_path" class="form-label">Cover Image</label>
            <input type="file" name="image_path" id="image_path" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
@endsection
