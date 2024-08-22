<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Book Management System') }}</title>
    <!-- Tailwind CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-100">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation Bar -->
        <nav class="bg-purple-700 p-4">
            <div class="container mx-auto flex justify-between items-center">
                <a href="{{ route('books.index') }}" class="text-2xl font-bold text-white">Book Management System</a>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('books.index') }}" class="text-gray-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Books</a>
                    <a href="{{ route('book_categories.index') }}" class="text-gray-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                    <a href="{{ route('authors.index') }}" class="text-gray-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Authors</a>

                    <!-- Authentication Links -->
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                    @else
                        <span class="text-gray-200 px-3 py-2 rounded-md text-sm font-medium">Hello, {{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}" class="text-gray-200 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow container mx-auto p-6">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-black p-4">
            <div class="container mx-auto text-center text-gray-500">
                &copy; {{ date('Y') }} Book Readers System. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
