@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    @endif
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-md-4 mb-4">
                <!-- random bg-color class -->
                @php
                    $bgClass = ['primary', 'secondary', 'success', 'danger', 'warning', 'info',  'dark'];
                    $randBgClass = $bgClass[array_rand($bgClass)];
                @endphp

                <!-- card -->
                       
                <div class="card bg-{{ $randBgClass }} ">
                    <div class="card-body ">
                        <h5 class="card-title text-white">{{ $category->name }}</h5>
                        @if (Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>
@endsection
