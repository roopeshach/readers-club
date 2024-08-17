@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Category</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="genre_name" class="form-label">Category Name</label>
                    <input type="text" name="genre_name" id="genre_name" class="form-control" value="{{ $category->genre_name }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
