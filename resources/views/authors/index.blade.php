@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-purple-400 mb-6">Authors</h2>

    <!-- Only show the "Add New Author" button if the user has permission -->
    @can('create', App\Models\Author::class)
    <div class="mb-4">
        <a href="{{ route('authors.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Add New Author</a>
    </div>
    @endcan

    <table class="min-w-full bg-gray-700 rounded-lg">
        <thead>
            <tr class="text-left border-b-2 border-gray-600">
                <th class="px-4 py-2">Author Name</th>
                @can('create', App\Models\Author::class)
                <th class="px-4 py-2">Actions</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr class="border-b border-gray-600">
                    <td class="px-4 py-2">{{ $author->author_name }}</td>
                    <td class="px-4 py-2">
                        <!-- Only show the "Edit" button if the user has permission -->
                        @can('update', $author)
                            <a href="{{ route('authors.edit', $author) }}" class="text-purple-400 hover:text-white">Edit</a> |
                        @endcan

                        <!-- Only show the "Delete" button if the user has permission -->
                        @can('delete', $author)
                            <form action="{{ route('authors.destroy', $author) }}" method="POST" class="inline">
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
        {{ $authors->links() }}
    </div>
</div>
@endsection
