@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <h1>Welcome to Readers Club</h1>
    @guest
        <a href="{{ route('login') }}">Login</a> | 
        <a href="{{ route('register') }}">Register</a>
    @else
        <p>Welcome back, {{ Auth::user()->name }}!</p>
        <a href="{{ route('books.index') }}">Go to Books</a>
    @endguest
@endsection
