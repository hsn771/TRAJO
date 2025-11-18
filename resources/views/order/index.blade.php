@extends('layouts.app_back')
@section('pageTitle','Orders')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <div class="row">
            <h3>Orders</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">Customer</th>
                        <th>Coupon</th>
                        <th>Total Price</th>
                        <th>Final Price</th>
                        <th>District</th>
                        <th>Division</th>
                        <th>Notes</th>
                        <th>Address</th>
                        <th>Discount</th>
                        <th>Payment Method</th>
                        <th>Transaction ID</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $d)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $d->customer?->name }}</td>
                            <td>{{ $d->coupon_id ?? '-' }}</td>
                            <td>{{ $d->total_price }}</td>
                            <td>{{ $d->final_price }}</td>
                            <td>{{ $d->district?->name ?? '-' }}</td>
                            <td>{{ $d->division?->name ?? '-' }}</td>
                            <td>{{ $d->notes ?? '-' }}</td>
                            <td>{{ $d->address ?? '-' }}</td>
                            <td>{{ $d->discount_amount ?? 0 }}</td>
                            <td>{{ ucfirst($d->payment_method ?? '-') }}</td>
                            <td>{{ $d->transaction_id ?? '-' }}</td>
                            <td>
                                @foreach($d->items ?? [] as $item)
                                    <div>
                                        {{ $item->product?->name ?? 'Product' }} 
                                        (Size: {{ $item->size ?? '-' }} x {{ $item->quantity }})
                                        - BDT {{ number_format($item->price * $item->quantity, 2) }}
                                    </div>
                                @endforeach
                            </td>
                            <td>{{ $d->status }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route('order.show', $d->id) }}">
                                    View
                                </a>
                                <a class="btn btn-info" href="{{ route('order.edit', $d->id) }}">
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('order.destroy', $d->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="text-center">No Orders Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
