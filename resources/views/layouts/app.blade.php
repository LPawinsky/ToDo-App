<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'To-Do List App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans">
    <header class="bg-blue-600 text-white shadow">
        <nav class="container mx-auto p-4">
            <ul class="flex space-x-4">
                <li>
                    <a href="{{ route('tasks.index') }}" class="hover:underline font-semibold">
                        Task list
                    </a>
                </li>
                @auth
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="hover:underline font-semibold">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>
    <main class="container mx-auto my-8 p-4 bg-white shadow rounded">
        @yield('content')
    </main>
    <footer class="text-white py-4">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} To-Do List App</p>
        </div>
    </footer>
    @stack('scripts')
</body>
</html>
