@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Books</h1>
    @auth 
        <p>Welcome back, {{ Auth::user()->name }}!</p>
        <div class="mb-3">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>
    @endauth
    
    <div class="table-responsive">
        <table id="books-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                    <tr>
                        <td><img src="{{ asset($book->image_path) }}" class="img-thumbnail" alt="{{ $book->book_name }}" style="height: 100px;"></td>
                        <td>{{ $book->book_name }}</td>
                        <td>{{ $book->published_by }}</td>
                        <td>{{ $book->genre->genre_name }}</td>
                        <td>{{ $book->view_count }}</td>
                        <td>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary">View Details</a>
                            @can('update', $book)
                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-outline-warning ms-2">Edit</a>
                            @endcan
                            @can('delete', $book)
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#books-table').DataTable({
                "searching": true,
                "ordering": true,
                "info": true
            });

            console.log(1);
        });
    </script>
@endsection


