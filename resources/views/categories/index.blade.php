@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Categories</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    <div class="card">
        <div class="card-body">
            <!-- Loop over cards -->
            <div class="row">
            @foreach($categories as $category)
            <div class="card m-1 col-md-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $category->name }}</h5>
                    @can('update', $category)
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan
                    @can('delete', $category)
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    @endcan
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
