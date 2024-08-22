@extends('layouts.app')

@section('head')
    <!-- DataTables CSS (if not included in the main layout) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <h1>Books</h1>

    @can('create', App\Models\Book::class)
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>
    @endcan

    <table id="books-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Code</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Owner</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <td>{{ $book->book_title }}</td>
                <td>{{ $book->book_code }}</td>
                <td>{{ $book->category->category_name }}</td>
                <td>{{ $book->publisher->publisher_name }}</td>
                <td>{{ $book->owner->name }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-info btn-sm">View</a>

                    @can('update', $book)
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan

                    @can('delete', $book)
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this book?');">
                                Delete
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Initialize DataTables -->
    <script>
        $(document).ready(function() {
            $('#books-table').DataTable({
                // Optional: Customize DataTables options here
                "columnDefs": [
                    { "orderable": false, "targets": -1 } // Disable ordering on the "Actions" column
                ]
            });
        });
    </script>
@endsection
