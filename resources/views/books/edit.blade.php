@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($book) ? 'Edit Book' : 'Add New Book' }}</h1>
    <hr>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($book))
            @method('PUT')
        @endif
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" value="{{ old('isbn', $book->isbn ?? '') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $book->author ?? '') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="publisher_id">Publisher</label>
            <select name="publisher_id" id="publisher_id" class="form-control" required>
                @foreach ($publishers as $publisher)
                    <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id ?? '') == $publisher->id ? 'selected' : '' }}>
                        {{ $publisher->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="edition">Edition</label>
            <input type="number" name="edition" id="edition" class="form-control" value="{{ old('edition', $book->edition ?? '') }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="cover_art">Cover Art</label>
            <input type="file" name="cover_art" id="cover_art" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($book) ? 'Update Book' : 'Add Book' }}</button>
    </form>
</div>
@endsection
