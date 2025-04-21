<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'status' => 'pending',
                'total_price' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            Cart::where('user_id', Auth::id())->delete();

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Order placed! Awaiting admin approval.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong.');
        }
    }

    public function index()
    {
        $orders = Order::with('items.product')->where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // Admin Panel
    public function adminIndex()
    {
        $orders = Order::with('user', 'items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function approve(Order $order)
    {
        $order->status = 'approved';
        $order->save();
        return back()->with('success', 'Order approved!');
    }

    public function reject(Order $order)
    {
        $order->status = 'rejected';
        $order->save();
        return back()->with('error', 'Order rejected.');
    }
}
