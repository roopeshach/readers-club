@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Publishers</h1>
    @can('create', App\Models\Publisher::class)
        <a href="{{ route('publishers.create') }}" class="btn btn-primary mb-3">Add New Publisher</a>
    @endcan
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publishers as $publisher)
                    <tr>
                        <td>{{ $publisher->name }}</td>
                        <td>{{ $publisher->location }}</td>
                        <td>
                            @can('update', $publisher)
                                <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endcan
                            @can('delete', $publisher)
                                <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $publishers->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>
@endsection
