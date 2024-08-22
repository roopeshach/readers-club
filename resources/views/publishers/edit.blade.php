@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Publisher</h1>
    <form action="{{ route('publishers.update', $publisher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="publisher_name">Publisher Name</label>
            <input type="text" class="form-control" id="publisher_name" name="publisher_name" value="{{ $publisher->publisher_name }}" required>
        </div>
        <div class="form-group">
            <label for="publisher_location">Publisher Location</label>
            <input type="text" class="form-control" id="publisher_location" name="publisher_location" value="{{ $publisher->publisher_location }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
