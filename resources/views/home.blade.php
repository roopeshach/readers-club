@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to Book Web</h1>
    <p>Explore a wide variety of books shared by our community.</p>
    <a href="{{ route('books.index') }}" class="btn btn-primary">View Books</a>
</div>
@endsection
