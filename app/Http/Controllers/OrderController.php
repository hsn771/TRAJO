<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Order::get();
        return view('order.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       Order::create($request->all());
       return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(order $order)
    {
        return view('order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(order $order)
    {
        return view('order.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, order $order)
    {
        try {
            // You may want to whitelist updatable fields instead of all()
            $order->update($request->all());
            return redirect()->route('order.index')->with('success', 'Order updated successfully.');
        } catch (\Exception $e) {
            return $e->getMessage();
            // Log the exception if you have logging configured
            // Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Failed to update order: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(order $order)
    {
       $order->delete();
       return redirect()->route('order.index');
    }
}
