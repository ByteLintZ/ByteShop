<!DOCTYPE html>
<html>
<head>
    <title>Order Receipt</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; margin-bottom: 0; }
        .logo {
            align-content: center;
            display: block;
            margin: 0 auto;
            height: 80px;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f3f3f3; }
    </style>
</head>
<body>
    <img src="{{ public_path('images/abstract-bg.png') }}" class="logo" alt="Logo"> <h1>ByteShop</h1>
    <h1>Order Receipt</h1>

    <p><strong>Order ID:</strong> #{{ $order->id }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
    <p><strong>Customer:</strong> {{ $order->user->name }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right;">Total: ${{ number_format($order->items->sum(fn($i) => $i->price * $i->quantity), 2) }}</h3>
</body>
</html>
