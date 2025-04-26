@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-3xl font-bold text-gray-800">🎨 Manage Categories</h2>
        <a href="{{ route('admin.categories.create') }}"
            class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:opacity-90 transition">
            + Add Category
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        @if($categories->isEmpty())
            <div class="p-6 text-center text-gray-600">
                <p class="text-lg">No categories found. 👀</p>
                <p class="text-sm mt-2">Start by adding your first category!</p>
            </div>
        @else
            <table class="w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left px-6 py-3 text-sm font-semibold text-gray-600">Name</th>
                        <th class="text-right px-6 py-3 text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-800">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="inline-flex items-center px-3 py-1 text-sm font-medium text-indigo-600 bg-indigo-50 rounded hover:bg-indigo-100">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline delete-category-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 bg-red-50 rounded hover:bg-red-100 delete-category-btn"
                                        data-category-name="{{ $category->name }}">
                                        🗑️ Delete
                                    </button>
                                </form>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<script>
    document.querySelectorAll('.delete-category-btn').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const categoryName = this.getAttribute('data-category-name');

            Swal.fire({
                title: `Delete "${categoryName}"?`,
                text: "This will also remove all related products. Are you absolutely sure?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-xl',
                    confirmButton: 'bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700',
                    cancelButton: 'bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection

