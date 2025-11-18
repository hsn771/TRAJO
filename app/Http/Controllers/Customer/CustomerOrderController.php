<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer_id= auth()->guard('customer')->id();
        $data=order::where('user_id',$customer_id)->get();
        return view('customer.order.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        return view('customer.order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
        $order->delete();
      return redirect()->back();
    }
}
