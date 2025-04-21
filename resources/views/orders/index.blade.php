@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Your Orders</h2>

    @forelse ($orders as $order)
        <div class="mb-6 p-4 bg-white shadow rounded">
            <p class="font-semibold">Order #{{ $order->id }} - <span class="text-sm text-gray-600">{{ $order->status }}</span></p>
            <ul class="mt-2">
                @foreach ($order->items as $item)
                    <li>{{ $item->product->name }} × {{ $item->quantity }} (${{ number_format($item->price, 2) }} each)</li>
                @endforeach
            </ul>
            <p class="mt-2 font-semibold">Total: ${{ number_format($order->total_price, 2) }}</p>
        </div>
    @empty
        <p>You haven’t placed any orders yet.</p>
    @endforelse
</div>
@endsection
