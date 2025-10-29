

     @extends('layouts.master')

    @section('content')


    <h1 style="text-align: center">Cart</h1>


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">Your Cart</p>
                        <h1 class="display-6">Items in Your Shopping Cart</h1>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id=>$item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>BDT{{ number_format($item['price'], 2) }}</td>
                                <td class="d-flex">
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="updateCart({{$id}},'decrease')">-</button>
                                        <input type="number" name="" id="" value="{{ $item['quantity'] }}" style="width: 40px; text-align: center;" readonly>
                                    <button type="button" class="btn btn-secondary btn-sm" onclick="updateCart({{$id}},'increase')">+</button>
                                </td>
                                <td>BDT{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteItem({{$id}})">
                                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                </svg>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div>
                        <input type="text" class="form-control mb-3" placeholder="Coupon Code" id="coupon_code">
                        <button class="btn btn-primary w-100" onclick="checkCoupon()">Apply Coupon</button>
                    </div>
                    <div class="section-title">
                        <p class="fs-5 fw-medium fst-italic text-primary">Cart Summary</p>
                        <h1 class="display-6">Order Summary</h1>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Subtotal
                            <span>
                                BDT {{ number_format(collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; }), 2) }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Discount
                            <span>

                                @if(isset(session()->get('coupon')['discount_amount']))
                                    BDT {{ number_format(session()->get('coupon')['discount_amount'], 2) }}
                                @else
                                    BDT 0.00
                                @endif
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total
                            <span>
                                 @if(isset(session()->get('coupon')['total_after_discount']))
                                    BDT {{ number_format(session()->get('coupon')['total_after_discount'], 2) }}
                                @else
                                    BDT {{ number_format(collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; }), 2) }}
                                @endif
                            </span>
                        </li>
                    </ul>
                    <a href="{{route('checkout')}}" class="btn btn-primary w-100 mt-3">Proceed to Checkout</a>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
    @endsection

@push('scripts')
<script>
    function deleteItem(id) {
        let url = "{{ route('cart.remove', '') }}/" + id;
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(url, {
            method: 'get',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            }
        }).then(response => response.json())
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    function updateCart(id, action) {
        let url = "{{ route('cart.update') }}";
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                product_id: id,
                action: action
            })
        }).then(response => response.json())
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function checkCoupon() {
        let coupon_code = document.getElementById('coupon_code').value;
        let url = "{{ route('cart.check_coupon') }}";
        let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({
                coupon_code: coupon_code
            })
        }).then(response => response.json())
        .then(data => {
            if(data.valid) {
                alert('Coupon applied! Discount: BDT' + data.discount);
            } else {
                alert('Invalid coupon code.');
            }
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endpush
