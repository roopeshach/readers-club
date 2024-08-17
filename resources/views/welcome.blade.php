@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="container text-center">
    <div class="jumbotron">
        <h1 class="display-4 text-primary">Welcome to Book Web</h1>
        <p class="lead">A place where you can share and manage your favorite books.</p>
        <hr class="my-4">
        @guest
            <p>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-lg">Register</a>
            </p>
        @else
            <p>Welcome back, {{ Auth::user()->name }}!</p>
            <a href="{{ route('home') }}" class="btn btn-success btn-lg">Go to Books</a>
        @endguest
    </div>
</div>
@endsection
