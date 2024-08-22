@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-purple-400 mb-6">Books</h2>

    <!-- Only show the "Add New Book" button if the user can create books -->
    @can('create', App\Models\Book::class)
    <div class="mb-4">
        <a href="{{ route('books.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Add New Book</a>
    </div>
    @endcan

    <table class="min-w-full bg-gray-700 rounded-lg">
        <thead>
            <tr class="text-left border-b-2 border-gray-600">
                <th class="px-4 py-2">Title</th>
                <th class="px-4 py-2">Author</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr class="border-b border-gray-600">
                    <td class="px-4 py-2">{{ $book->book_title }}</td>
                    <td class="px-4 py-2">{{ $book->author->author_name }}</td>
                    <td class="px-4 py-2">{{ $book->category->category_name }}</td>
                    <td class="px-4 py-2">
                        <!-- Everyone can view the book -->
                        <a href="{{ route('books.show', $book) }}" class="text-purple-400 hover:text-white">View</a>

                        <!-- Only show the "Edit" button if the user can update this book -->
                        @can('update', $book)
                            | <a href="{{ route('books.edit', $book) }}" class="text-purple-400 hover:text-white">Edit</a>
                        @endcan

                        <!-- Only show the "Delete" button if the user can delete this book -->
                        @can('delete', $book)
                            | <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
