@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Your Cart</h2>

    @if ($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <div class="bg-white shadow p-4 rounded">
                <table class="w-full mb-4">
                    <thead>
                        <tr class="text-left border-b">
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr class="border-b">
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Checkout</button>
            </div>
        </form>
    @endif
</div>
@endsection
