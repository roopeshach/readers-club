@extends('layouts.app')

@section('head')
    <!-- DataTables CSS (if not included in the main layout) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
<div class="container">
    <h1>Publishers</h1>

    @can('create', App\Models\Publisher::class)
        <a href="{{ route('publishers.create') }}" class="btn btn-primary mb-3">Add New Publisher</a>
    @endcan

    <table id="publishers-table" class="table table-bordered">
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
                <td>{{ $publisher->publisher_name }}</td>
                <td>{{ $publisher->publisher_location }}</td>
                <td>
                    @can('update', $publisher)
                        <a href="{{ route('publishers.edit', $publisher->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endcan

                    @can('delete', $publisher)
                        <form action="{{ route('publishers.destroy', $publisher->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this publisher?');">
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
    <!-- Initialize DataTables for Publishers -->
    <script>
        $(document).ready(function() {
            $('#publishers-table').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": -1 } // Disable ordering on the "Actions" column
                ]
            });
        });
    </script>
@endsection
