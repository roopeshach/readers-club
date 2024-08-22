@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $publisher->name }}</h1>
    <p><strong>Address:</strong> {{ $publisher->address }}</p>
    <p><strong>Website:</strong> <a href="{{ $publisher->website }}" target="_blank">{{ $publisher->website }}</a></p>

    <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
@endsection
