@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>
    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="book_title">Book Title</label>
            <input type="text" class="form-control" id="book_title" name="book_title" value="{{ $book->book_title }}" required>
        </div>
        <div class="form-group">
            <label for="book_code">Book Code</label>
            <input type="text" class="form-control" id="book_code" name="book_code" value="{{ $book->book_code }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="publisher_id">Publisher</label>
            <select class="form-control" id="publisher_id" name="publisher_id" required>
                @foreach($publishers as $publisher)
                <option value="{{ $publisher->id }}" {{ $publisher->id == $book->publisher_id ? 'selected' : '' }}>
                    {{ $publisher->publisher_name }}
                </option>
                @endforeach
            </select>
        </div>
      
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
