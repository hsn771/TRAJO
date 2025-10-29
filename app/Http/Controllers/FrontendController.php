<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function welcome() {
        $products = \App\Models\Product::all();
        return view ('welcome', compact('products'));
    }
}
