@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-8">📦 Pending Orders</h2>

    @forelse ($orders as $order)
        <div class="bg-white shadow-lg rounded-xl p-6 mb-8 border border-gray-200 transition hover:shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-lg font-semibold text-gray-700">👤 {{ $order->user->name }}</p>
                    <p class="text-sm text-gray-400">Order #{{ $order->id }}</p>
                </div>
                <span class="inline-block text-sm bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full font-medium">⏳ Pending</span>
            </div>

            <ul class="list-disc list-inside text-gray-700 mb-4">
                @foreach ($order->items as $item)
                    <li>
                        <span class="font-medium">{{ $item->product->name }}</span>
                        <span class="text-gray-500">× {{ $item->quantity }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="flex items-center justify-between">
                <p class="text-xl font-bold text-gray-800">💰 ${{ number_format($order->total_price, 2) }}</p>

                <div class="flex gap-3">
                    <form method="POST" action="{{ route('admin.orders.approve', $order) }}">
                        @csrf
                        <button class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-4 py-2 rounded-lg shadow-sm transition">
                            ✅ Approve
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.orders.reject', $order) }}">
                        @csrf
                        <button class="bg-rose-500 hover:bg-rose-600 text-white font-semibold px-4 py-2 rounded-lg shadow-sm transition">
                            ❌ Reject
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500">
            👀 No pending orders at the moment. Go grab a latte ☕
        </div>
    @endforelse
</div>
@endsection
