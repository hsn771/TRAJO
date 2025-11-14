<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial; margin:0; padding:0; }
        .invoice-wrapper { padding: 20px; width: 800px; margin:auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f2f2f2; }
        @media print {
            .invoice-wrapper { margin:0; width:100%; }
        }
    </style>
</head>
<body>
    <div class="invoice-wrapper">
        <h2>TRAJO Clothing.</h2>
        <p>Address: Halishahar, Chattogram</p>
        <p>Phone: +8801625127621 | Email: trajo@gmail.com</p>

        <h3>Invoice #{{ $order->id }}</h3>
        <p>Customer: {{ $order->customer?->name }}</p>
        <p>Date: {{ $order->created_at->format('d M Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product?->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->unit_price, 2) }} BDT</td>
                    <td>{{ number_format($item->line_total, 2) }} BDT</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p>Subtotal: {{ number_format($order->total_price, 2) }} BDT</p>
        <p>Discount: {{ number_format($order->discount_amount, 2) }} BDT</p>
        <p><strong>Total: {{ number_format($order->final_price, 2) }} BDT</strong></p>

        <button onclick="window.print()">Print Invoice</button>
    </div>
</body>
</html>
