{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-100 to-blue-300 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-2xl font-bold text-blue-700">Welcome, {{ Auth::user()->name }}!</h3>
                <p class="mt-2 text-gray-600">Your role is: {{ auth()->user()->role->name }}</span></p>
            </div>
        </div>
    </div>
</x-app-layout>
