@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Publisher</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('publishers.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                    <input type="url" name="website" id="website" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
