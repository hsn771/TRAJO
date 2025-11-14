@extends('layouts.master')
@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="/">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-lg-3">
                <div class="shop__sidebar">

                    <!-- Search -->
                    <div class="shop__sidebar__search">
                        <form action="/shop" method="GET">
                            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>

                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">

                            <!-- CATEGORIES -->
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                @foreach ($categories as $cat)
                                                    <li>
                                                        <a href="/shop?category_id={{ $cat->id }}">
                                                            {{ $cat->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- PRODUCTS -->
            <!-- PRODUCTS -->
<div class="col-lg-9">

    <div class="shop__product__option">
        <div class="row">
            <div class="col-lg-6">
                <div class="shop__product__option__left">
                    <p>Showing {{ $products->count() }} results</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row product__filter">
        @forelse ($products as $product)
        <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{asset('uploads/'.$product->image_url)}}">
                    <span class="label">New</span>
                    <ul class="product__hover">
                        <!-- Wishlist -->
                        <li>
                            <a href="javascript:void(0)" onclick="addToWishlist({{ $product->id }})">
                                <img src="{{ asset('assets/img/icon/heart.png') }}" alt="">
                            </a>
                        </li>
                        <!-- Compare -->
                        <li>
                            <a href="#"><img src="{{ asset('assets/img/icon/compare.png') }}" alt=""> <span>Compare</span></a>
                        </li>
                        <!-- Quick View / Search -->
                        <li>
                            <a href="#"><img src="{{ asset('assets/img/icon/search.png') }}" alt=""></a>
                        </li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6>{{ $product->name }}</h6>
                    <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})" class="add-cart">+ Add To Cart</a>
                    <div class="rating">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <h5>BDT {{ $product->price }}</h5>
                    <!-- <div class="product__color__select">
                        <label for="pc-1">
                            <input type="radio" id="pc-1">
                        </label>
                        <label class="active black" for="pc-2">
                            <input type="radio" id="pc-2">
                        </label>
                        <label class="grey" for="pc-3">
                            <input type="radio" id="pc-3">
                        </label>
                    </div> -->
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p>No products found.</p>
        </div>
        @endforelse
    </div>

    <div class="row mt-4">
        <div class="col-lg-12 text-center">
            {{ $products->links() }}
        </div>
    </div>

</div>

        </div>
    </div>
</section>
<!-- Shop Section End -->

@endsection
