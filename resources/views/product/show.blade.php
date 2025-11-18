@extends('layouts.master')

@section('content')

<section class="product-details spad">
    <div class="container">

        <div class="row">

            <!-- LEFT SIDE: IMAGES -->
            <div class="col-lg-6">

                <!-- MAIN IMAGE -->
                <div class="main-image mb-3">
                    <img id="mainProductImage" 
                         src="{{ asset('uploads/' . $product->image_url) }}" 
                         class="img-fluid"
                         style="width:100%; border-radius:10px; object-fit:cover;">
                </div>

                <!-- GALLERY IMAGES -->
                <div class="row">

                    <!-- Main Image As Thumbnail -->
                    <div class="col-3 mb-2">
                        <img src="{{ asset('uploads/' . $product->image_url) }}"
                             class="img-thumbnail gallery-thumb"
                             onclick="changeImage(this.src)"
                             style="cursor:pointer;">
                    </div>

                    <!-- Gallery Images -->
                    @if(!empty($product->gallery_images))
                        @foreach($product->gallery_images as $img)
                            <div class="col-3 mb-2">
                                <img src="{{ asset('uploads/gallery/' . $img) }}" 
                                     class="img-thumbnail gallery-thumb"
                                     onclick="changeImage(this.src)"
                                     style="cursor:pointer;">
                            </div>
                        @endforeach
                    @endif

                </div>

            </div>

            <!-- RIGHT SIDE: PRODUCT INFO -->
            <div class="col-lg-6">
                <h3>{{ $product->name }}</h3>

                <h4 class="text-primary">BDT {{ number_format($product->price) }}</h4>

                <p class="mt-3">{{ $product->description }}</p>

                <!-- PRODUCT SIZE -->
                <div class="mt-4">
                    <label><strong>Size:</strong></label>
                    <div class="d-flex mt-2">
                        @foreach(['S','M','L','XL'] as $size)
                            <div class="mr-2">
                                <input type="radio" id="size-{{ $size }}" name="size" value="{{ $size }}">
                                <label for="size-{{ $size }}" class="btn btn-outline-secondary">{{ $size }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- PRODUCT QUANTITY -->
                <div class="mt-3">
                    <label><strong>Quantity:</strong></label>
                    <div class="input-group" style="width:120px;">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button" onclick="decreaseQty()">-</button>
                        </div>
                        <input type="text" id="quantity" class="form-control text-center" value="1">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" onclick="increaseQty()">+</button>
                        </div>
                    </div>
                </div>

                <!-- ADD TO CART BUTTON -->
                <button onclick="addToCart({{ $product->id }})" 
                        class="primary-btn mt-4" 
                        style="padding:10px 25px;">
                    Add To Cart
                </button>
            </div>

        </div>

    </div>
</section>

<!-- IMAGE & QUANTITY SCRIPT -->
<script>
    // Change main image when clicking thumbnail
    function changeImage(src) {
        document.getElementById('mainProductImage').src = src;
    }

    // Quantity increase / decrease
    function increaseQty() {
        let qty = document.getElementById('quantity');
        qty.value = parseInt(qty.value) + 1;
    }

    function decreaseQty() {
        let qty = document.getElementById('quantity');
        if (parseInt(qty.value) > 1) {
            qty.value = parseInt(qty.value) - 1;
        }
    }
</script>

@endsection
