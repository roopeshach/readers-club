@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Publishers</h1>
    <div class="mb-3">
        <a href="{{ route('publishers.create') }}" class="btn btn-primary">Add New Publisher</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Website</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($publishers as $publisher)
                <tr>
                    <td>{{ $publisher->name }}</td>
                    <td>{{ $publisher->address }}</td>
                    <td><a href="{{ $publisher->website }}" target="_blank">{{ $publisher->website }}</a></td>
                    <td>
                        <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No publishers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
