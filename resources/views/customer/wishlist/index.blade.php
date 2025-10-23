@extends('layouts.customer')
@section('content')

<div class="container py-5">
    <h2 class="mb-4 text-center">My Wishlist</h2>

    <div class="row">
        @forelse($wishlists as $wishlist)
            <div class="col-md-3 mb-4 text-center" id="wishlist-item-{{ $wishlist->id }}">
                <div class="product-entry border">
                    <a href="{{ route('productdescription', $wishlist->product->id) }}" class="prod-img">
                        <img src="{{ asset('uploads/' . $wishlist->product->image_url) }}" class="img-fluid" alt="">
                    </a>
                    <div class="desc">
                        <h2><a href="#">{{ $wishlist->product->name }}</a></h2>
                        <span class="price">BDT {{ $wishlist->product->price }}</span>

                        <!-- Add to Cart -->
                        <a href="javascript:void(0)" onclick="addToCart({{ $wishlist->product->id }})" class="btn btn-dark rounded-pill py-2 px-4 m-2">
                            Add to Cart <i class="fa fa-cart-plus ms-2"></i>
                        </a>

                        <!-- Remove from Wishlist -->
                        <a href="javascript:void(0)" onclick="removeFromWishlist({{ $wishlist->id }})" class="btn btn-outline-danger rounded-pill py-2 px-4">
                            <i class="fa fa-trash"></i> Remove
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No items in wishlist.</p>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
    function addToCart(productId) {
        fetch("{{ route('cart.add') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(() => {
            alert('Failed to add product to cart.');
        });
    }

    function removeFromWishlist(wishlistId) {
        fetch(`/wishlist/${wishlistId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            document.querySelector(`#wishlist-item-${wishlistId}`).remove();
        })
        .catch(() => {
            alert('Failed to remove item.');
        });
    }
</script>
@endpush
