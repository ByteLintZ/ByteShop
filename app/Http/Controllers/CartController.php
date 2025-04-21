<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);
        $cartItem->quantity += $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    public function remove($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
