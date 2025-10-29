<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
     public function addToCart(Request $request)
    {
        $product = \App\Models\Product::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => "No product found."], 404);
        }

        $cart=session::get('cart', []);
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->discount_price ?? $product->price,
            'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
            'vendor_id'=>$product->vendor_id
        ];

        session::put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully']);
    }
     public function updateCart(Request $request)
    {
        $product = \App\Models\Product::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => $request->all()], 404);
        }

        $cart=session::get('cart', []);
        if(!isset($cart[$product->id])) {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }

        if($request->action === 'decrease' && $cart[$product->id]['quantity'] > 1) {
            $cart[$product->id]['quantity']--;
        } elseif($request->action === 'increase') {
            $cart[$product->id]['quantity']++;
        }
        session::put('cart', $cart);
        // if($cart[$product->id]['quantity'] <= 0) {
        //     unset($cart[$product->id]);
        //     session::put('cart', $cart);
        //     return response()->json(['message' => 'Product removed from cart successfully']);
        // }

        return response()->json(['message' => 'Product added to cart successfully']);
    }

    public function viewCart()
    {
        $cart = session::get('cart', []);
        return view('cart', compact('cart'));
    }

    public function removeFromCart($id)
    {
        $cart = session::get('cart', []);
        if (!isset($cart[$id])) {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }
        unset($cart[$id]);
        session::put('cart', $cart);
        session::forget('coupon');

        return response()->json(['message' => 'Product removed from cart successfully']);
    }

    public function checkCoupon(Request $request)
    {
        $total=0;
        $cart = session::get('cart', []);
        foreach($cart as $id=>$item){
            $total+=$item['price'] * $item['quantity'];
        }
        $check=\App\Models\Coupon::where('code',$request->coupon_code)
                    ->where('is_active',1)
                    ->where('start_date','<=',date('Y-m-d'))
                    ->where('end_date','>=',date('Y-m-d'))
                    ->where('usage_limit','>',0)
                    ->where('min_order_amount','<=',$total)
                    ->first();
        if($check){

            if($check->discount_type==1)
                $discount=($total * $check->discount_value)/100;
            else
                $discount=$check->discount_value;

            $total_after_discount=$total-$discount;
            session::put('coupon',[
                'code'=>$check->code,
                'coupon_id'=>$check->id,
                'discount'=>$check->discount_value,
                'discount_amount'=>$discount,
                'total_after_discount'=>$total_after_discount
            ]);
            return response()->json(['valid' => true, 'discount' => $discount]);
        }else{
            return response()->json(['valid' => false, 'message' => 'Invalid coupon code']);
        }
    }
}
