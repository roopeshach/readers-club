@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($book) ? 'Edit Book' : 'Add New Book' }} {{ old('title', $book->title ?? '') }} </h1>
    <hr>
    <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($book))
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher', $book->publisher ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="edition">Edition</label>
            <input type="number" name="edition" id="edition" class="form-control" value="{{ old('edition', $book->edition ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cover_art">Cover Art</label>
            <input type="file" name="cover_art" id="cover_art" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning">{{ isset($book) ? 'Update Book' : 'Add Book' }}</button>
    </form>
</div>
@endsection
