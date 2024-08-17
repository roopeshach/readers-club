@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $author->name }}</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Bio:</strong></p>
            <p>{{ $author->biography }}</p>
            <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning">Edit Author</a>
        </div>
    </div>
</div>
@endsection
