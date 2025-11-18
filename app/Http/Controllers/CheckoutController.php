<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Illuminate\Support\Facades\Session;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Show the checkout page
     */
    public function checkout()
    {
        $cart = Session::get('cart', []);
        $cupon = Session::get('coupon', []);
        $districts = District::all();
        $divisions = Division::all();
        return view('checkout', compact('cart', 'cupon', 'districts', 'divisions'));
    }

    /**
     * Place order and save order items with size, payment method and transaction ID
     */
    public function placeOrder(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'division_id' => 'required|exists:divisions,id',
                'district_id' => 'required|exists:districts,id',
                'notes' => 'nullable|string|max:1000',
                'sizes' => 'required|array',
                'sizes.*' => 'required|string|in:S,M,L,XL',
                'payment_method' => 'required|string|in:bkash,nagad,cash',
                'transaction_id' => 'required_if:payment_method,bkash,nagad|string|max:255',
            ]);

            // Check if customer exists
            $checkCustomer = Customer::where('email', $request->email)
                            ->orWhere('phone', $request->phone)->first();

            if (!$checkCustomer) {
                $customer = new Customer();
                $customer->name = $request->name;
                $customer->email = $request->email;
                $customer->phone = $request->phone;
                $customer->address = $request->address;
                $customer->division_id = $request->division_id;
                $customer->district_id = $request->district_id;
                if ($request->login && $request->password) {
                    $customer->password = bcrypt($request->password);
                }
                $customer->save();
            } else {
                $customer = $checkCustomer;
            }

            $cart = Session::get('cart', []);
            if (empty($cart)) {
                return redirect()->back()->with('error', 'Your cart is empty!');
            }

            // Create Order
            $order = new Order();
            $order->user_id = $customer->id;
            $order->total_price = array_sum(array_map(function($item) {
                return $item['price'] * $item['quantity'];
            }, $cart));

            if (Session::has('coupon')) {
                $order->coupon_id = Session::get('coupon.coupon_id');
                $order->discount_amount = Session::get('coupon.discount_amount');
                $order->final_price = Session::get('coupon.total_after_discount');
            } else {
                $order->coupon_id = null;
                $order->discount_amount = 0;
                $order->final_price = $order->total_price;
            }

            $order->notes = $request->notes;
            $order->division_id = $request->division_id;
            $order->district_id = $request->district_id;
            $order->address = $request->address;
            $order->status = 'pending';

            // Add payment details
            $order->payment_method = $request->payment_method;
            $order->transaction_id = $request->transaction_id ?? null;

            $order->save();

            // Create Order Items
            foreach ($cart as $id => $item) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $id;
                $orderItem->quantity = $item['quantity'];
                $orderItem->price = $item['price'];
                $orderItem->line_total = $item['price'] * $item['quantity'];
                $orderItem->size = $request->sizes[$id] ?? null;
                $orderItem->save();
            }

            // Clear cart and coupon
            Session::forget('cart');
            Session::forget('coupon');

            return redirect()->route('welcome')->with('success', 'Order placed successfully');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
