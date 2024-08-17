@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Book</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
                </div>
                
                <!-- ISBN -->
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" value="{{ $book->isbn }}" required>
                </div>
                
                <!-- Author -->
                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" id="author_id" class="form-control" required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Category -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Publisher -->
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" name="publisher" id="publisher" class="form-control" value="{{ $book->publisher }}">
                </div>
                
                <!-- Edition -->
                <div class="mb-3">
                    <label for="edition" class="form-label">Edition</label>
                    <input type="text" name="edition" id="edition" class="form-control" value="{{ $book->edition }}">
                </div>
                
              
                
                <!-- Cover Art -->
                <div class="mb-3">
                    <label for="cover_art" class="form-label">Cover Art</label>
                    <input type="file" name="cover_art" id="cover_art" class="form-control">
                    @if($book->cover_art)
                        <img src="{{ asset($book->cover_art) }}" alt="{{ $book->title }}" class="img-fluid mt-2" style="max-height: 200px;">
                    @endif
                </div>

                <!-- Update Button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
