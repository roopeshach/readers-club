@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Categories</h1>

    <!-- Session Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
    </div>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $category->genre_name }}</h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
