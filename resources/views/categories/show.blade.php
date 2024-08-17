@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $category->name }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Description:</strong></p>
            <p>{{ $category->description }}</p>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit Category</a>
        </div>
    </div>
</div>
@endsection
