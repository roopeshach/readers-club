<x-app-layout>
    <x-slot name="header">
        <div class="jumbotron bg-primary text-white text-center py-5 mb-4">
            <div class="container">
                <h1 class="display-4">Dashboard</h1>
                <p class="lead">Welcome to your personalized dashboard. Manage your books, categories, and publishers with ease.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h2 class="card-title">Welcome!</h2>
                            <p class="card-text">You're logged in and ready to start managing your library.</p>
                            <a href="{{ route('books.index') }}" class="btn btn-primary mt-3">Go to Books</a>
                            <a href="{{ route('book_categories.index') }}" class="btn btn-secondary mt-3">Manage Categories</a>
                            <a href="{{ route('publishers.index') }}" class="btn btn-secondary mt-3">Manage Publishers</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
