@extends('layouts.customer')

@section('title', 'Order Invoice No=' . $order->id)

@push('styles')
<style>
    body {
        background-color: #f7fdf9;
    }

    .invoice-container {
        max-width: 850px;
        margin: 40px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border-top: 6px solid #28a745;
        position: relative;
    }

    .invoice-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .invoice-header h2 {
        color: #28a745;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .invoice-header p {
        color: #6c757d;
        margin: 0;
        font-size: 15px;
    }

    .invoice-details p {
        margin: 4px 0;
        font-size: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fdfdfd;
        border-radius: 8px;
        overflow: hidden;
    }

    th {
        background-color: #28a745;
        color: white;
        padding: 10px;
        text-align: left;
        font-weight: 600;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    tbody tr:hover {
        background-color: #eaf8ee;
        transition: background 0.3s ease;
    }

    .summary {
        background-color: #f1fef3;
        padding: 15px;
        border-radius: 8px;
        margin-top: 20px;
        border: 1px solid #d4edda;
    }

    .summary p {
        margin: 6px 0;
        font-weight: 500;
        font-size: 16px;
    }

    .summary strong {
        color: #28a745;
    }

    .btn-primary {
        background-color: #28a745;
        border: none;
        border-radius: 6px;
        padding: 10px 18px;
        font-size: 15px;
        transition: background 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #218838;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 6px;
        padding: 10px 18px;
        font-size: 15px;
        color: #fff;
        transition: background 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .button-group {
        text-align: center;
        margin-top: 20px;
    }

    .badge {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 13px;
        color: #fff;
    }

    .badge.bg-warning { background-color: #ffc107 !important; color: #000; }
    .badge.bg-success { background-color: #28a745 !important; }
    .badge.bg-secondary { background-color: #6c757d !important; }

    @media print {
        body {
            background-color: #fff;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            box-shadow: none;
            border: none;
        }
        .no-print, header, nav, footer {
            display: none !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="invoice-container">
        <div class="invoice-header">
            <h2>Invoice No={{ $order->id }}</h2>
            <p>Thank you for shopping with us 💚</p>
        </div>

        <div class="invoice-details">
            <p><strong>Customer:</strong> {{ $order->customer?->name }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Status:</strong> 
                <span class="badge 
                    @if($order->status == 'pending') bg-warning 
                    @elseif($order->status == 'completed') bg-success 
                    @else bg-secondary @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
        </div>

        <h4 class="mt-4 mb-2 text-success text-center">Order Items</h4>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (৳)</th>
                    <th>Total (৳)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($order->orderItems as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->product?->name }}</td>
                        <td>{{ $d->quantity }}</td>
                        <td>{{ number_format($d->unit_price, 2) }}</td>
                        <td>{{ number_format($d->line_total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No items found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="summary">
            <p><strong>Total Price:</strong> ৳{{ number_format($order->total_price, 2) }}</p>
            <p><strong>Discount:</strong> ৳{{ number_format($order->discount_amount, 2) }}</p>
            <p><strong>Final Price:</strong> <span style="color:#218838;">৳{{ number_format($order->final_price, 2) }}</span></p>
        </div>

        <div class="button-group no-print">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="icon-print"></i> Print Invoice
            </button>
            <a href="{{ route('customer_panel.order.index') }}" class="btn btn-secondary">
                <i class="icon-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
</div>
@endsection
