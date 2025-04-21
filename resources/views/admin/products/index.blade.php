@extends('layouts.admin')

@section('content')
<div class="p-6" x-data="productManager">
    <!-- Page Header -->
    <h1 class="text-3xl font-bold mb-6 text-center text-white bg-gradient-to-r from-blue-500 to-indigo-600 py-4 rounded shadow-lg">
        Manage Products
    </h1>

    <!-- Add Product Button -->
    <div class="flex justify-end mb-4">
        <button @click="showCreateModal = true" class="bg-gradient-to-r from-green-400 to-green-600 text-white px-6 py-3 rounded shadow hover:from-green-500 hover:to-green-700 transition duration-300">
            + Add Product
        </button>
    </div>

    <!-- Product Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white">
                <tr>
                    <th class="text-left p-3">Image</th>
                    <th class="text-left p-3">Name</th>
                    <th class="text-left p-3">Category</th>
                    <th class="text-left p-3">Price</th>
                    <th class="text-left p-3">Stock</th>
                    <th class="text-left p-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="p-3">
                        <img src="{{ asset($product->image) }}" alt="Product" class="w-16 h-16 object-cover rounded">
                    </td>
                    <td class="p-3">{{ $product->name }}</td>
                    <td class="p-3">{{ $product->category->name }}</td>
                    <td class="p-3 text-green-600 font-semibold">${{ $product->price }}</td>
                    <td class="p-3">{{ $product->stock }}</td>
                    <td class="p-3 space-x-2">
                        <button @click="editProduct({{ $product->toJson() }})" class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-3 py-1 rounded shadow hover:from-yellow-500 hover:to-yellow-600 transition duration-300">
                            Edit
                        </button>
                        <button @click="confirmDelete({{ $product->id }})" class="bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-1 rounded shadow hover:from-red-600 hover:to-red-700 transition duration-300">
                            Delete
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->links() }}
    </div>

    <!-- Create Product Modal -->
    <div x-show="showCreateModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3" @click.away="closeCreateModal">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Add Product</h2>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="name" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Category</label>
                    <select name="category_id" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Stock</label>
                    <input type="number" name="stock" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Image</label>
                    <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea name="description" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="closeCreateModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded hover:from-blue-600 hover:to-indigo-700 transition duration-300">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div x-show="showEditModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3" @click.away="closeEditModal">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Edit Product</h2>
            <form method="POST" :action="editUrl" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-gray-700">Name</label>
                    <input type="text" name="name" x-model="editProductData.name" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Category</label>
                    <select name="category_id" x-model="editProductData.category_id" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" x-model="editProductData.price" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Stock</label>
                    <input type="number" name="stock" x-model="editProductData.stock" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Image (optional)</label>
                    <input type="file" name="image" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <!-- Optionally, add an image preview for the edit modal if desired -->
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea name="description" x-model="editProductData.description" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <div class="flex justify-end gap-4">
                    <button type="button" @click="closeEditModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded hover:from-blue-600 hover:to-indigo-700 transition duration-300">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 md:w-1/2 lg:w-1/3" @click.away="closeDeleteModal">
            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">Are you sure?</h2>
            <p class="mb-4 text-center text-gray-600">This action cannot be undone.</p>
            <form method="POST" :action="deleteUrl">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-4">
                    <button type="button" @click="closeDeleteModal" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition duration-300">
                        Cancel
                    </button>
                    <button type="submit" class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded hover:from-red-600 hover:to-red-700 transition duration-300">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Alpine.js -->
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('productManager', () => ({
            showCreateModal: false,
            showEditModal: false,
            showDeleteModal: false,
            deleteUrl: '',
            editUrl: '',
            editProductData: {},
            editProduct(product) {
                // Set the edit URL (assuming your route name is admin.products.update)
                this.editUrl = `/admin/products/${product.id}`;
                // Preload the product data into the edit form
                this.editProductData = {
                    name: product.name,
                    category_id: product.category_id,
                    price: product.price,
                    stock: product.stock,
                    description: product.description,
                };
                this.showEditModal = true;
            },
            closeEditModal() {
                this.showEditModal = false;
                this.editProductData = {};
            },
            closeCreateModal() {
                this.showCreateModal = false;
            },
            closeDeleteModal() {
                this.showDeleteModal = false;
            },
            confirmDelete(id) {
                this.deleteUrl = `/admin/products/${id}`;
                this.showDeleteModal = true;
            }
        }));
    });
</script>
@endsection
