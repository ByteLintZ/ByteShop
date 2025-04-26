@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-12">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Category</h2>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                <input type="text" name="name" id="name" value="{{ $category->name }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
            </div>

            <div class="flex justify-between space-x-2">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition">Cancel</a>

                <button type="submit"
                    class="px-5 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg shadow hover:opacity-90 transition">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
