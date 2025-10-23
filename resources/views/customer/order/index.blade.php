@extends('layouts.customer')
@section('content')

<div class="container mt-4">
    <h2>Orders</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Coupon</th>
                <th>Status</th>
                <th>Discount Amount</th>
                <th>Total Price</th>
                <th>Final Price</th>
                <th>Division</th>
                <th>District</th>
                <th>Notes</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $i=>$d)
                <tr>
                    <td>{{ $d->id }}</td>
                    <td>{{ $d->coupon?->code }}</td>
                    <td>{{ $d->status }}</td>
                    <td>{{ $d->discount_amount }}</td>
                    <td>{{ $d->total_price }}</td>
                    <td>{{ $d->final_price }}</td>
                    <td>{{ $d->division?->name }}</td>
                    <td>{{ $d->district?->name }}</td>
                    <td>{{ $d->notes }}</td>
                    <td>{{ $d->address }}</td>
                    <td>
                        <a href="{{ route('customer_panel.order.show', $d->id) }}" class="btn btn-sm btn-warning">Invoice</a>
                        @if($d->status=="pending")
                            <form action="{{ route('customer_panel.order.destroy', $d->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this order?');">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text-center">No orders found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
