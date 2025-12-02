@extends('layouts.master')
@section('content')

<!-- Hero Section Begin -->
<section class="hero">
   

    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="{{ asset('assets/img/hero/hero-1.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2025</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="{{ route( 'shop') }}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero__items set-bg" data-setbg="{{ asset('assets/img/hero/hero-2.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2025</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="{{ route('shop') }}" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram')}}"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- Hero Section End -->


<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="{{ asset('assets/img/banner/banner-1.jpg')}}" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Clothing Collections 2025</h2>
                        <a href="{{ route('shop') }}">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->


<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li data-filter=".new-arrivals">New Arrivals</li>
                </ul>
            </div>
        </div>

        <div class="row product__filter">
            @forelse ($products as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals">

                <div class="product__item">
                    <a href="{{ route('product.show', $product->id) }}">
                        <div class="product__item__pic set-bg" data-setbg="{{ asset('uploads/' . $product->image_url) }}">
                            <span class="label">New</span>
                            <ul class="product__hover">
                                <li>
                                    <a href="javascript:void(0)" onclick="addToWishlist({{ $product->id }})">
                                        <img src="{{ asset('assets/img/icon/heart.png') }}" alt="">
                                    </a>
                                </li>
                                <li><a href="#"><img src="{{ asset('assets/img/icon/compare.png') }}" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="{{ asset('assets/img/icon/search.png') }}" alt=""></a></li>
                            </ul>
                        </div>
                    </a>

                    <div class="product__item__text">
                        <h6>{{ $product->name }}</h6>
                        <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})" class="add-cart">+ Add To Cart</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>
                        </div>
                        <h5>BDT {{ $product->price }}</h5>
                    </div>
                </div>

            </div>
            @empty
            @endforelse
        </div>

    </div>
</section>
<!-- Product Section End -->


<!-- Instagram, Blog etc remain SAME (unchanged) -->


@endsection


@push('scripts')

<!-- 🔍 AJAX LIVE SEARCH SCRIPT -->



<!-- Add to Cart -->
<script>
function addToCart(productId) {
    fetch("{{ route('cart.add') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(() => alert('Product added to cart!'))
    .catch(() => alert('Failed to add product.'));
}
</script>

<!-- Add to Wishlist -->
<script>
function addToWishlist(productId) {
    fetch("{{ route('wishlist.add') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(data => alert(data.message))
    .catch(() => alert('Something went wrong.'));
}
</script>

@endpush
