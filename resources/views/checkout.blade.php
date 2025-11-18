@extends('layouts.master')
@section('content')

<h1 class="text-center mb-5">Checkout</h1>

<div class="container-xxl py-5">
    <div class="container">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('checkout.place_order') }}" method="POST">
            @csrf
            <div class="row g-5">

                <!-- BILLING FORM -->
                <div class="col-lg-6">
                    <div class="section-title mb-4">
                        <p class="fs-5 fw-medium fst-italic text-primary">Bill Information</p>
                    </div>

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="full_name" value="{{ old('name') }}" placeholder="Enter your full name">
                        @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="Enter your email">
                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}" placeholder="Enter your phone">
                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="division_id" class="form-label">Division</label>
                        <select name="division_id" class="form-select" id="division" onchange="fetchDistricts(this.value)">
                            <option value="">Select your division</option>
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                            @endforeach
                        </select>
                        @error('division_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="district_id" class="form-label">District</label>
                        <select name="district_id" class="form-select" id="district">
                            <option value="">Select your district</option>
                            @foreach($districts as $district)
                                <option class="dist dist{{ $district->division_id }}" value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                            @endforeach
                        </select>
                        @error('district_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}" placeholder="Enter your address">
                        @error('address')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Order Notes</label>
                        <textarea name="notes" class="form-control" id="notes" rows="3" placeholder="Additional notes">{{ old('notes') }}</textarea>
                        @error('notes')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <span>
                        <input type="checkbox" name="login" id="login" onchange="checkAcc(this)"/>
                        Create customer account when checkout?
                    </span>
                    <br/>

                    <div class="mb-3" id="acc_field" style="display: none;">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <!-- PAYMENT METHOD -->
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-select" onchange="toggleTransaction(this)">
                            <option value="">Select Payment Method</option>
                            <option value="bkash" {{ old('payment_method') == 'bkash' ? 'selected' : '' }}>Bkash</option>
                            <option value="nagad" {{ old('payment_method') == 'nagad' ? 'selected' : '' }}>Nagad</option>
                            <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash on Delivery</option>
                        </select>
                        @error('payment_method')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-3" id="transaction_field" style="display: none;">
                        <label for="transaction_id" class="form-label">Transaction ID</label>
                        <input type="text" name="transaction_id" id="transaction_id" class="form-control" value="{{ old('transaction_id') }}" placeholder="Enter your transaction ID">
                        @error('transaction_id')<span class="text-danger">{{ $message }}</span>@enderror
                    </div>

                </div>

                <!-- CART SUMMARY -->
                <div class="col-lg-6">
                    <div class="section-title mb-4">
                        <p class="fs-5 fw-medium fst-italic text-primary">Your Cart</p>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>
                                    <select name="sizes[{{ $id }}]" class="form-select">
                                        <option value="">Select Size</option>
                                        <option value="S" {{ old("sizes.$id") == 'S' ? 'selected' : '' }}>S</option>
                                        <option value="M" {{ old("sizes.$id") == 'M' ? 'selected' : '' }}>M</option>
                                        <option value="L" {{ old("sizes.$id") == 'L' ? 'selected' : '' }}>L</option>
                                        <option value="XL" {{ old("sizes.$id") == 'XL' ? 'selected' : '' }}>XL</option>
                                    </select>
                                    @error('sizes.'.$id)<span class="text-danger">{{ $message }}</span>@enderror
                                </td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>BDT {{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3">Subtotal</th>
                                <td>BDT {{ number_format(collect($cart)->sum(function($item){ return $item['price'] * $item['quantity']; }), 2) }}</td>
                            </tr>
                            <tr>
                                <th colspan="3">Discount</th>
                                <td>@if(isset($cupon['discount_amount'])) BDT {{ number_format($cupon['discount_amount'],2) }} @else BDT 0.00 @endif</td>
                            </tr>
                            <tr>
                                <th colspan="3">Total</th>
                                <td>@if(isset($cupon['total_after_discount'])) BDT {{ number_format($cupon['total_after_discount'],2) }} @else BDT {{ number_format(collect($cart)->sum(function($item){ return $item['price'] * $item['quantity']; }),2) }} @endif</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Place Order</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function fetchDistricts(divisionId) {
        document.querySelectorAll('.dist').forEach(el => el.style.display = 'none');
        document.querySelectorAll('.dist' + divisionId).forEach(el => el.style.display = 'block');
    }

    function checkAcc(checkbox) {
        document.getElementById('acc_field').style.display = checkbox.checked ? 'block' : 'none';
    }

    function toggleTransaction(select) {
        if(select.value === 'bkash' || select.value === 'nagad') {
            document.getElementById('transaction_field').style.display = 'block';
        } else {
            document.getElementById('transaction_field').style.display = 'none';
        }
    }
</script>
@endpush
