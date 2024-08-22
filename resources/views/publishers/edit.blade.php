@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Publisher</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $publisher->name) }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="address">Location</label>
            <input type="text" name="location" id="address" class="form-control" value="{{ old('location', $publisher->location) }}">
        </div>
      
        <button type="submit" class="btn btn-primary">Update Publisher</button>
    </form>
</div>
@endsection
