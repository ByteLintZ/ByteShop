@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Pending Orders</h2>

    @foreach ($orders as $order)
        <div class="bg-white shadow p-4 rounded mb-6">
            <div class="mb-2">
                <strong>User:</strong> {{ $order->user->name }}  
                <span class="text-gray-500 text-sm">#{{ $order->id }}</span>
            </div>
            <ul>
                @foreach ($order->items as $item)
                    <li>{{ $item->product->name }} × {{ $item->quantity }}</li>
                @endforeach
            </ul>
            <p class="mt-2">Total: ${{ number_format($order->total_price, 2) }}</p>
            <div class="flex gap-2 mt-4">
                <form method="POST" action="{{ route('admin.orders.approve', $order) }}">
                    @csrf
                    <button class="bg-green-500 text-white px-3 py-1 rounded">Approve</button>
                </form>
                <form method="POST" action="{{ route('admin.orders.reject', $order) }}">
                    @csrf
                    <button class="bg-red-500 text-white px-3 py-1 rounded">Reject</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
