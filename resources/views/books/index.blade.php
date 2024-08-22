@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Books</h1>
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>
    <table class="table table-bordered">
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
                <td>{{ $book->owner->username }}</td>
                <td>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $books->links() }}
</div>
@endsection
