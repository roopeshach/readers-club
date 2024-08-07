@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1>Dashboard</h1>

    @auth
    <!-- A card showing you are logged in or else login to view books and others -->
    <div class="card text-white bg-dark mb-3">
        <div class="card-body">
            <h5 class="card-title">Welcome back, {{ Auth::user()->name }}!</h5>
            <p class="card-text">You are logged in. You can now view books, categories, and members.</p>
        </div>
    </div>
    @else
    <div class="card text-white bg-danger mb-3">
        <div class="card-body">
            <h5 class="card-title">You are not logged in!</h5>
            <p class="card-text">Please login to view books, categories, and members.</p>
            <!-- login button -->
             <a href="{{ route('login') }}" class="btn btn-warning">Login</a>
        </div>
    </div>
    @endauth
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Books</h5>
                    <p class="card-text">{{ $bookCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text">{{ $categoryCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Members</h5>
                    <p class="card-text">{{ $membersCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <h2>Most Viewed Books</h2>
    <div id="mostViewedBooksCarousel" class="" >
        <div class="carousel-inner row">
            @foreach($mostViewedBooks as $key => $book)
                <div class="col-md-4 ">
                    <div class="card m-2 p-3 ">
                        <img width="150" height="200" src="{{ asset($book->cover_art) }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">{{ $book->author }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlKO87bg6a2rJRYO4z9QhBoC1hlWbUI5QY1zqTxpFHTI/8ZPytq4gT1p7RB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9bL4KJH3MCH4k4niW/jtc2t6LxrTyt5YMEkQ15Vylg6Q9qj54I1+7kt" crossorigin="anonymous"></script>
@endsection
