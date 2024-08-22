@extends('layouts.app')

@section('content')
<div class="jumbotron bg-dark text-white text-center py-5 mb-4">
    <div class="container">
        <h1 class="display-4">Readers Club </h1>
        <p class="lead">Welcome to Book Management dashboard. Here you can manage your books, categories, and publishers.</p>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5 class="card-title">{{ __('You are logged in!') }}</h5>
                    <p class="card-text">Use the links below to manage your library:</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary">Go to Books</a>
                    <a href="{{ route('book_categories.index') }}" class="btn btn-success">Manage Categories</a>
                    <a href="{{ route('publishers.index') }}" class="btn btn-danger">Manage Publishers</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
