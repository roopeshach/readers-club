@extends('layouts.app')

@section('head')
    <!-- DataTables CSS (if not included in the main layout) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="container">
    <h1>Categories</h1>

    @can('create', App\Models\BookCategory::class)
        <a href="{{ route('book_categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    @endcan

    <table id="categories-table" class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>
                    @can('update', $category)
                        <a href="{{ route('book_categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan

                    @can('delete', $category)
                        <form action="{{ route('book_categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this category?');">
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
    <!-- Initialize DataTables for Categories -->
    <script>
        $(document).ready(function() {
            $('#categories-table').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": -1 } // Disable ordering on the "Actions" column
                ]
            });
        });
    </script>
@endsection
