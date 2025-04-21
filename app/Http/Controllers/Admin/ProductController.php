<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        // Filtering
        $query = Product::query();
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->with('category')->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'  => 'nullable|string',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Use the original file name (you might want to modify this to prevent conflicts)
            $fileName = $file->getClientOriginalName();
            // Move the file to the public/products directory
            $file->move(public_path('products'), $fileName);
            // Set the image path (relative to the public directory)
            $imagePath = 'products/' . $fileName;
        }
    
        Product::create([
            'name'         => $request->name,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'category_id'  => $request->category_id,
            'image'        => $imagePath,
            'description'  => $request->description,
        ]);
    
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product added successfully.');
    }
    


    /**
     * Update an existing product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'price'        => 'required|numeric|min:0',
            'stock'        => 'required|integer|min:0',
            'category_id'  => 'required|exists:categories,id',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'  => 'nullable|string',
        ]);
    
        // Image Handling
        if ($request->hasFile('image')) {
            // Optionally delete the previous image file if needed:
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('products'), $fileName);
            $imagePath = 'products/' . $fileName;
            $product->image = $imagePath;
        }
    
        $product->update($request->only('name', 'price', 'stock', 'category_id', 'description'));
    
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully.');
    }
    


    /**
     * Delete a product.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
