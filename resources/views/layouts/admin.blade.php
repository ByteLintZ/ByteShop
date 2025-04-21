<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - @yield('title', 'Manage Products')</title>
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (using CDN, ensure you use the appropriate version) -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <!-- Header / Navbar -->
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
            <nav>
                <a href="{{ route('dashboard') }}" class="mr-4 hover:underline">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="mr-4 hover:underline">Products</a>
                <a href="{{ route('profile.edit') }}" class="hover:underline">Profile</a>
            </nav>
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
