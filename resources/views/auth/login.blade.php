{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>
    <!-- Fullscreen container with a navy-blue gradient background -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-900 to-blue-500 relative ">
        <!-- Optional decorative shapes for extra visual appeal -->
        <div class="absolute inset-0 flex items-center justify-center opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" width="400" height="400" fill="none" viewBox="0 0 24 24" class="text-blue-200">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle>
            </svg>
        </div>

        <!-- Logo/Brand Icon -->
        <div class="z-10 mb-4">
            <img src="{{ asset('images/abstract-bg.png') }}" alt="Store Icon" class="w-20 h-20">
        </div>

        <!-- Header with store name and subtitle -->
        <div class="z-10 text-center mb-6">
            <h1 class="text-5xl font-extrabold text-white drop-shadow-lg">ByteShop</h1>
            <p class="mt-2 text-xl italic text-blue-100">Electronics &amp; Hardware Store</p>
        </div>

        <!-- Login Form Container -->
        <div class="z-10 w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl rounded-2xl">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address Field -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-300 rounded-md shadow-sm" 
                        type="email" 
                        name="email" 
                        required 
                        autofocus 
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-600" />
                </div>

                <!-- Password Field -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
                    <x-text-input 
                        id="password" 
                        class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-300 rounded-md shadow-sm"
                        type="password"
                        name="password"
                        required 
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Remember Me Checkbox -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                               name="remember">
                        <span class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Footer actions: Forgot password link and Login button -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <!-- Primary Button with gradient background -->
                    <x-primary-button class="ml-3 bg-gradient-to-r from-blue-700 to-blue-500 hover:from-blue-800 hover:to-blue-600 text-white font-bold py-2 px-6 rounded-md transition duration-300 shadow-md">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
