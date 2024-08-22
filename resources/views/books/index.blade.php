@extends('layouts.app')

@section('content')

<style>
    table.dataTable thead .sorting, 
table.dataTable thead .sorting_asc, 
table.dataTable thead .sorting_desc {
    background: none;
}
</style>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar for Categories -->
        <div class="col-md-2">
            <h5>Filter by Category:</h5>
            <ul class="list-group mb-3">
                <li class="list-group-item">
                    <a class="btn btn-lg btn-warning"  href="{{ route('books.index') }}">Show All</a>
                </li>
                @foreach ($categories as $category)
                    <li class="list-group-item ">
                        <a class="btn btn-lg btn-light" href="{{ route('books.index', ['category' => $category->id]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <h1>Books</h1>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (Auth::check())
                <a href="{{ route('books.create') }}" class="btn btn-warning mb-3">Add New Book</a>
            @endif

            <!-- Search Bar -->
            <div class="mb-3">
                <form action="{{ route('books.index') }}" method="GET">
                    <input type="text" name="search" class="form-control" placeholder="Search for books..." value="{{ request('search') }}">
                </form>
            </div>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td><img src="{{ asset($book->cover_art) }}" alt="{{ $book->title }}" style="height: 100px;"></td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td>
                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-warning">View Details</a>
                                @if (Auth::check() && Auth::user()->isAdmin())
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $books->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var svgs = document.querySelectorAll('svg');
            svgs.forEach(function(svg) {
                svg.style.display = 'none';
            });
        });
    </script>
@endsection