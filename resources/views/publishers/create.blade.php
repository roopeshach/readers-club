@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Publisher</h1>
    <form action="{{ route('publishers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="publisher_name">Publisher Name</label>
            <input type="text" class="form-control" id="publisher_name" name="publisher_name" required>
        </div>
        <div class="form-group">
            <label for="publisher_location">Publisher Location</label>
            <input type="text" class="form-control" id="publisher_location" name="publisher_location">
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
