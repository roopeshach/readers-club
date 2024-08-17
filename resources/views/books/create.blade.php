@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Book</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                
                <!-- ISBN -->
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" required>
                </div>
                
                <!-- Author -->
                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" id="author_id" class="form-control" required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Category -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Publisher -->
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" name="publisher" id="publisher" class="form-control">
                </div>
                
                <!-- Edition -->
                <div class="mb-3">
                    <label for="edition" class="form-label">Edition</label>
                    <input type="text" name="edition" id="edition" class="form-control">
                </div>
                
             
                
                <!-- Cover Art -->
                <div class="mb-3">
                    <label for="cover_art" class="form-label">Cover Art</label>
                    <input type="file" name="cover_art" id="cover_art" class="form-control">
                </div>

                <!-- Save Button -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
