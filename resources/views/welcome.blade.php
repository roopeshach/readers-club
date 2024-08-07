@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Welcome to Readers Club</h1>
        @guest
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Register</a>
        @else
            <p class="lead">Welcome back, {{ Auth::user()->name }}!</p>
            <a href="{{ route('books.index') }}" class="btn btn-primary btn-lg">Go to Books</a>
        @endguest
    </div>
</div>
@endsection
