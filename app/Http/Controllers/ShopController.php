<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        if ($request->category) {
            $query->where('category_id', $request->category);
        }
    
        $products = $query->latest()->get();
        $categories = Category::orderBy('name')->get(); // <--- ADD this
    
        return view('shop.index', compact('products', 'categories')); // <--- PASS it here too
    }
}
