<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - @yield('title', 'Manage Products')</title>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Alpine.js for dropdowns -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <!-- Header / Navbar -->
    <header class="bg-gradient-to-r from-purple-600 to-indigo-700 text-white p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo + Links -->
            <div class="flex items-center space-x-6">
                <h1 class="text-xl font-bold tracking-wide">✨ Admin Dashboard</h1>
                <a href="{{ route('admin.orders.index') }}" class="hover:underline">Pending Orders</a>
                <a href="{{ route('admin.products.index') }}" class="hover:underline">Products</a>
                <a href="{{ route('admin.categories.index') }}" class="hover:underline">Categories</a>
            </div>
    
            <!-- Profile Dropdown -->
            @auth
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-700 hover:bg-purple-600 focus:outline-none transition">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="w-4 h-4 ml-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-lg shadow-lg z-50 overflow-hidden">
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-2 hover:bg-gray-100">Log Out</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </header>
    
    

    <!-- Main Content -->
    <main class="container mx-auto p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-center p-4 mt-6">
        &copy; {{ date('Y') }} Your Company. All rights reserved.
    </footer>
</body>
</html>
