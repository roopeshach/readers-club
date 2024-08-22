@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-purple-400 mb-6">Categories</h2>

    <!-- Only show the "Add New Category" button if the user has permission -->
    @can('create', App\Models\BookCategory::class)
    <div class="mb-4">
        <a href="{{ route('book_categories.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Add New Category</a>
    </div>
    @endcan

    <table class="min-w-full bg-gray-700 rounded-lg">
        <thead>
            <tr class="text-left border-b-2 border-gray-600">
                <th class="px-4 py-2">Category Name</th>
                @can('create', App\Models\BookCategory::class)
                <th class="px-4 py-2">Actions</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="border-b border-gray-600">
                    <td class="px-4 py-2">{{ $category->category_name }}</td>
                    <td class="px-4 py-2">
                        <!-- Only show the "Edit" button if the user has permission -->
                        @can('update', $category)
                            <a href="{{ route('book_categories.edit', $category->id) }}" class="text-purple-400 hover:text-white">Edit</a> |
                        @endcan

                        <!-- Only show the "Delete" button if the user has permission -->
                        @can('delete', $category)
                            <form action="{{ route('book_categories.destroy', $category->id) }}" method="POST" class="inline">
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
        {{ $categories->links() }}
    </div>
</div>
@endsection
