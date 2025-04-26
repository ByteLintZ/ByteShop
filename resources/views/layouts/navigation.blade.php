<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-600 to-indigo-700 p-4 text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ auth()->user()?->is_admin ? '/dashboard' : '/shop' }}" class="text-xl font-bold">
            🌟 ByteShop
        </a>

        <!-- Navigation + Profile -->
        <div class="flex items-center space-x-6">
            <ul class="flex space-x-4 items-center">
                @auth
                    @if(auth()->user()->is_admin)
                        <li><a href="/dashboard" class="hover:underline">Admin Dashboard</a></li>

                    @else
                        <li><a href="/shop" class="hover:underline">Shop</a></li>
                        <li><a href="/cart" class="hover:underline">Cart</a></li>
                        <li><a href="/orders" class="hover:underline">My Orders</a></li>
                    @endif
                @endauth
            </ul>

            <!-- Breeze's Profile Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-purple-700 hover:bg-purple-600 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-2">
                                <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @endauth
        </div>

        <!-- Hamburger Menu -->
        <div class="sm:hidden flex items-center">
            <button @click="open = ! open" class="text-white focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden mt-2 px-4">
        @auth
            <div class="py-2 space-y-1">
                @if(auth()->user()->is_admin)
                    <x-responsive-nav-link :href="route('dashboard')">Admin Dashboard</x-responsive-nav-link>
                @else
                    <x-responsive-nav-link href="/shop">Shop</x-responsive-nav-link>
                    <x-responsive-nav-link href="/cart">Cart</x-responsive-nav-link>
                    <x-responsive-nav-link href="/orders">My Orders</x-responsive-nav-link>
                @endif
            </div>

            <div class="border-t border-purple-300 pt-3">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        @else
            <x-responsive-nav-link :href="route('login')">Login</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')">Register</x-responsive-nav-link>
        @endauth
    </div>
</nav>
