@extends('layouts.master')
@section('content')


    <h1 style="text-align: center">Checkout</h1>


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <form action="{{route('checkout.place_order')}}" method="POST" class="wow fadeIn" data-wow-delay="0.1s">
                        @csrf

                        <div class="section-title">
                            <p class="fs-5 fw-medium fst-italic text-primary">Bill Information</p>
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" id="full_name" placeholder="Enter your full name">
                            @if ($errors->has('name'))
                                <span class="text-danger"> {{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                            @if ($errors->has('email'))
                                <span class="text-danger"> {{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone number">
                            @if ($errors->has('phone'))
                                <span class="text-danger"> {{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="division_id" class="form-label">Division</label>
                            <select name="division_id" class="form-select" id="division" onchange="fetchDistricts(this.value)">
                                <option selected>Select your division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('division_id'))
                                <span class="text-danger"> {{ $errors->first('division_id') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="district_id" class="form-label">District</label>
                            <select name="district_id" class="form-select" id="district">
                                <option selected>Select your district</option>
                                @foreach($districts as $district)
                                    <option class="dist dist{{$district->division_id}}" value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('district_id'))
                                <span class="text-danger"> {{ $errors->first('district_id') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address (Shipping)</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Enter your address">
                            @if ($errors->has('address'))
                                <span class="text-danger"> {{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="notes" class="form-label">Order Notes</label>
                            <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="Additional notes about your order"></textarea>
                            @if ($errors->has('notes'))
                                <span class="text-danger"> {{ $errors->first('notes') }}</span>
                            @endif
                        </div>
                        <span>
                            <input type="checkbox" name="login" id="login" onchange="checkAcc(this)"/>
                            Create customer account when checkout?
                        </span>
                        <br/>
                        <div class="mb-3" id="acc_field" style="display: none;">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                            @if ($errors->has('password'))
                                <span class="text-danger"> {{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col"></th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id=>$item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>BDT{{ number_format($item['price'], 2) }} X {{ $item['quantity'] }}</td>
                                <td> BDT{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">Subtotal</th>
                                <td>BDT {{ number_format(collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; }), 2) }}</td>
                            </tr>
                            <tr>
                                <th colspan="2">Discount</th>
                                <td>
                                    @if(isset($cupon['discount_amount']))
                                        BDT {{ number_format($cupon['discount_amount'], 2) }}
                                    @else
                                        BDT 0.00
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th colspan="2">Total</th>
                                <td>
                                     @if(isset($cupon['total_after_discount']))
                                        BDT {{ number_format($cupon['total_after_discount'], 2) }}
                                    @else
                                        BDT {{ number_format(collect($cart)->sum(function($item) { return $item['price'] * $item['quantity']; }), 2) }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- About End -->
    @endsection

@push('scripts')
<script>

    function fetchDistricts(divisionId) {
        // Hide all districts
        document.querySelectorAll('.dist').forEach(function(el) {
            el.style.display = 'none';
        });
        // Show districts that belong to the selected division
        document.querySelectorAll('.dist' + divisionId).forEach(function(el) {
            el.style.display = 'block';
        });
    }
    function checkAcc(checkbox) {
        var accField = document.getElementById('acc_field');
        if (checkbox.checked) {
            accField.style.display = 'block';
        } else {
            accField.style.display = 'none';
        }
    }
</script>
@endpush
