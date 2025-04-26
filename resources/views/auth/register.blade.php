{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <!-- Fullscreen container with a navy-blue gradient background -->
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-900 to-blue-500">
        <!-- Optional decorative background shape for visual depth -->
        

         <!-- Logo/Brand Icon -->
         <div class="z-10 mb-4">
            <img src="{{ asset('images/abstract-bg.png') }}" alt="Store Icon" class="w-20 h-20">
        </div>

        <!-- Header Section: Store name and tagline -->
        <div class="z-10 text-center mb-8">
            <h1 class="text-5xl font-bold text-white drop-shadow-lg">ByteShop</h1>
            <p class="mt-2 text-xl text-blue-200">Join our community for the best electronics deals!</p>
        </div>

        <!-- Registation Form Container -->
        <div class="z-10 w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl rounded-2xl">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name Field -->
                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-gray-700" />
                    <x-text-input 
                        id="name" 
                        class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-300 rounded-md shadow-sm" 
                        type="text" 
                        name="name" 
                        required 
                        autofocus 
                        autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-600" />
                </div>

                <!-- Email Address Field -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input 
                        id="email" 
                        class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-300 rounded-md shadow-sm" 
                        type="email" 
                        name="email" 
                        required 
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
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600" />
                </div>

                <!-- Confirm Password Field -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
                    <x-text-input 
                        id="password_confirmation" 
                        class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring focus:ring-blue-300 rounded-md shadow-sm" 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-600" />
                </div>

                <!-- Footer Actions: Link to login and Register Button -->
                <div class="flex items-center justify-end mt-6">
                    <a class="underline text-sm text-blue-600 hover:text-blue-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-3 bg-gradient-to-r from-blue-700 to-blue-500 hover:from-blue-800 hover:to-blue-600 text-white font-bold py-2 px-6 rounded-md transition duration-300 shadow-md">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
