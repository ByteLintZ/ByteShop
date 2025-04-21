<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>ByteShop</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* You can include some fallback styles here if needed */
            </style>
        @endif
    </head>
    <body class="font-sans antialiased">
        <!-- Main container with a navy-blue gradient background -->
        <div class="relative min-h-screen bg-gradient-to-br from-blue-900 to-blue-500 text-white overflow-hidden">
            <!-- Decorative SVG (subtle background shape) -->
            <div class="absolute inset-0 opacity-10">
                <svg
                    class="w-full h-full"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 800 600"
                >
                    <circle cx="400" cy="300" r="250" fill="currentColor" />
                </svg>
            </div>

            <!-- Content container -->
            <div class="relative z-10 container mx-auto px-6 py-10">
                <!-- Header / Navigation -->
                <header class="flex flex-col sm:flex-row justify-between items-center py-6">
                    <!-- Logo / Brand Name -->
                    <div class="flex items-center mb-4 sm:mb-0">
                        <!-- Replace with your own logo if available -->
                        <img
                            src="{{ asset('images/abstract-bg.png') }}"
                            alt="ByteShop Logo"
                            class="w-12 h-12 mr-3"
                        />
                        <span class="text-2xl font-extrabold">ByteShop</span>
                    </div>

                    <!-- Navigation Links -->
                    <nav class="flex space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a
                                    href="{{ url('/dashboard') }}"
                                    class="px-4 py-2 border border-white rounded hover:bg-white hover:text-blue-900 transition duration-300"
                                >
                                    Dashboard
                                </a>
                            @else
                                <a
                                    href="{{ route('login') }}"
                                    class="px-4 py-2 border border-white rounded hover:bg-white hover:text-blue-900 transition duration-300"
                                >
                                    Log in
                                </a>
                                @if (Route::has('register'))
                                    <a
                                        href="{{ route('register') }}"
                                        class="px-4 py-2 border border-white rounded hover:bg-white hover:text-blue-900 transition duration-300"
                                    >
                                        Register
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </nav>
                </header>

                <!-- Hero Section -->
                <main class="text-center mt-16">
                    <h1 class="text-5xl sm:text-6xl font-extrabold drop-shadow-lg">
                        Welcome to ByteShop
                    </h1>
                    <p class="mt-4 text-xl sm:text-2xl text-blue-200">
                        Your one-stop destination for electronics &amp; hardware.
                    </p>
                    <div class="mt-8">
                        <a
                            href="#explore"
                            class="inline-block bg-white text-blue-900 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition duration-300"
                        >
                            Explore Now
                        </a>
                    </div>
                </main>

                <!-- Optional Content Sections -->
                <section id="explore" class="mt-20">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Example Card 1 -->
                        <div class="bg-white bg-opacity-90 text-blue-900 rounded-2xl p-6 shadow-2xl transition transform hover:scale-105">
                            <h2 class="text-2xl font-bold mb-2">Discover Amazing Products</h2>
                            <p class="text-base">
                                Browse our wide range of top-notch electronics and hardware. Enjoy seamless shopping and exceptional customer service.
                            </p>
                        </div>
                        <!-- Example Card 2 -->
                        <div class="bg-white bg-opacity-90 text-blue-900 rounded-2xl p-6 shadow-2xl transition transform hover:scale-105">
                            <h2 class="text-2xl font-bold mb-2">Exclusive Deals & Offers</h2>
                            <p class="text-base">
                                Stay updated with our latest deals and offers to get the best value for your money.
                            </p>
                        </div>
                    </div>
                </section>

                <!-- Footer -->
                <footer class="mt-20 py-6 text-center text-sm border-t border-white/20">
                    <p>&copy; {{ date('Y') }} ByteShop. All rights reserved.</p>
                    <p class="mt-2">
                        Powered by Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </p>
                </footer>
            </div>
        </div>
    </body>
</html>
