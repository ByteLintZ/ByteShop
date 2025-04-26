@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8">🛍️ Explore Our Electronics</h1>

    {{-- Filters --}}
    <form method="GET" action="{{ route('shop.index') }}" class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        {{-- Search Bar --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">🔍 Search Products</label>
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Search by name..."
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400">
        </div>

        {{-- Category Filter --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">📂 Category</label>
            <select name="category" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Filter Button --}}
        <div>
            <button type="submit"
                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-sm px-4 py-3 rounded-lg shadow hover:opacity-90 transition">
                🎛️ Apply Filters
            </button>
        </div>
    </form>

    {{-- Product Grid --}}
    @if($products->isEmpty())
        <p class="text-gray-500">No products found. Try adjusting your filters 👑</p>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($products as $product)
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition duration-300 overflow-hidden relative group">
            <img src="{{ asset('/' . $product->image) }}" 
                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300" 
                 alt="{{ $product->name }}">

            @if($product->stock < 5)
                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">Low Stock!</span>
            @endif

            <div class="p-5 space-y-2">
                <h2 class="text-lg font-bold text-gray-800">{{ $product->name }}</h2>

                <span class="inline-block bg-indigo-100 text-indigo-600 text-xs px-3 py-1 rounded-full">
                    {{ $product->category->name }}
                </span>

                {{-- Fake Ratings --}}
                <div class="flex items-center space-x-1 text-yellow-400 text-sm">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-4 h-4 {{ $i < rand(3,5) ? 'fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.122-6.545L.488 6.91l6.566-.955L10 0l2.946 5.955 6.566.955-4.756 4.635 1.122 6.545z"/>
                        </svg>
                    @endfor
                </div>

                <p class="text-2xl text-blue-600 font-extrabold">${{ number_format($product->price, 2) }}</p>

                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex items-center space-x-2 mt-2">
                    @csrf
                    <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1"
                        class="w-16 border border-gray-300 rounded p-1 text-center text-sm focus:ring-2 focus:ring-blue-300">
                    
                    <button type="submit"
                        class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm px-4 py-2 rounded-lg shadow hover:opacity-90 transition flex items-center space-x-1">
                        <span>🛒</span> <span>Add</span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
