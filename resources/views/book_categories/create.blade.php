@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-lg">
    <h2 class="text-3xl font-semibold text-purple-400 mb-6">Create New Category</h2>

    <form action="{{ route('book_categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="category_name" class="block text-gray-300">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="w-full p-2 rounded bg-gray-900 text-gray-100" required>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Create Category</button>
        </div>
    </form>
</div>
@endsection
