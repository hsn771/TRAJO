@extends('layouts.app_back')
@section('pageTitle','Edit Products')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <h3>Update Order #{{ $order->id }}</h3>
            <form action="{{route('order.update', $order->id)}}" method="post">
                @csrf
                @method('PATCH')
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card p-3 mb-3">
                            <h5>Order Summary</h5>
                            <p><strong>Order ID:</strong> {{ $order->id }}</p>
                            <p><strong>Status:</strong> <span class="badge bg-secondary">{{ $order->status }}</span></p>
                            <p><strong>Total Price:</strong> {{ number_format($order->total_price,2) ?? '-' }}</p>
                            <p><strong>Discount:</strong> {{ number_format($order->discount_amount ?? 0,2) }}</p>
                            <p><strong>Final Price:</strong> {{ number_format($order->final_price ?? $order->total_price,2) }}</p>
                            @if($order->coupon)
                                <p><strong>Coupon:</strong> {{ $order->coupon->code ?? '-' }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card p-3 mb-3">
                            <h5>Customer Details</h5>
                            <p><strong>Name:</strong> {{ $order->customer?->name ?? 'N/A' }}</p>
                            <p><strong>Email:</strong> {{ $order->customer?->email ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $order->customer?->phone ?? 'N/A' }}</p>
                            <p><strong>Address:</strong> {{ $order->current_address ?? ($order->customer?->address ?? 'N/A') }}</p>
                            <p><strong>Division / District:</strong> {{ $order->division?->name ?? '-' }} / {{ $order->district?->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Order Items</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Size</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Line Total</th>
                                    <th>Item Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $status = [
                                        'pending' => 'Pending',
                                        'delivered' => 'Delivered',
                                        'cancel' => 'Canceled'
                                    ];
                                @endphp
                                @forelse ($order->orderItems as $index => $or)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $or->product?->name ?? 'N/A' }}</td>
                                        <td>{{ $or->size ?? $or->size_id ?? '-' }}</td>
                                        <td>{{ $or->quantity }}</td>
                                        <td>{{ number_format($or->unit_price ?? $or->price,2) }}</td>
                                        <td>{{ number_format($or->line_total ?? ($or->quantity * ($or->unit_price ?? $or->price)),2) }}</td>
                                        <td>{{ $status[$or->status] ?? $or->status }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No items found.</td></tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="status">Order Status </label>
                    <select name="status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="pending" @if($order->status=="pending") selected @endif>Pending</option>
                        <option value="delivered" @if($order->status=="delivered") selected @endif>Delivered</option>
                        <option value="cancel" @if($order->status=="canceled") selected @endif>Cancel</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-info mt-3">Update Status</button>
            </form>
        </div>
    </div>
</div>


@endsection
