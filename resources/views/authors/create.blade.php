@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Author</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('authors.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="bio" class="form-label">Bio</label>
                    <textarea name="biography" id="biography" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
