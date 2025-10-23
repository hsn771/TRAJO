@extends('layouts.app_back')
@section('pageTitle','Order Invoice')
@section('content')

{{-- <div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-body"> --}}
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Order Invoice</h2>
                    <a href="javascript:window.print()" class="btn btn-primary">Print</a>
                </div>

                <table class="table table-bordered">
                    <tr>
                        <th>Customer</th>
                        <td>{{ $order->customer?->name }}</td>
                    </tr>
                    <tr>
                        <th>Invoice No.</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Address</th>
                        <td>
                            {{ $order->address }} <br>
                            {{ $order->district?->name }} <br>
                            {{ $order->division?->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><span class="badge bg-info">{{ ucfirst($order->status) }}</span></td>
                    </tr>
                </table>

                <h4 class="mt-4">Order Items</h4>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Line Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($order->orderItems as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->product?->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->unit_price, 2) }} BDT</td>
                                <td>{{ number_format($item->line_total, 2) }} BDT</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No items found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total Price:</th>
                            <th>{{ number_format($order->total_price, 2) }} BDT</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-end">Discount Amount:</th>
                            <th>{{ number_format($order->discount_amount, 2) }} BDT</th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-end">Final Price:</th>
                            <th>{{ number_format($order->final_price, 2) }} BDT</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    {{-- </div> --}}
</div>

@endsection
