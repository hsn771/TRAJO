<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $userId = auth('customer')->id();
        $wishlists = Wishlist::with('product')->where('user_id', $userId)->get();
        return view('customer.wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $userId = auth('customer')->id();

        // Check if already added
        $exists = Wishlist::where('user_id', $userId)
                          ->where('product_id', $request->product_id)
                          ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already in wishlist']);
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $request->product_id,
        ]);

        return response()->json(['message' => 'Added to wishlist']);
    }

    public function destroy($id)
{
    $wishlist = \App\Models\Wishlist::where('user_id', auth()->id())
                                      ->where('id', $id)
                                      ->first();

    if (!$wishlist) {
        return response()->json(['message' => 'Item not found in wishlist'], 404);
    }

    $wishlist->delete();

    return response()->json(['message' => 'Item removed from wishlist successfully']);
}

}
