@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Category</h1>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="genre_name" class="form-label">Category Name</label>
                    <input type="text" name="genre_name" id="genre_name" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
