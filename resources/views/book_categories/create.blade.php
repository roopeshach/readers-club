@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Category</h1>
    <form action="{{ route('book_categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
