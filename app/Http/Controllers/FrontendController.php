<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class FrontendController extends Controller
{
    public function welcome() {
        $products = Product::all();
        return view('welcome', compact('products'));
    }

    public function shop(Request $request) {
        $categoryId = $request->category_id;
        $search = $request->search;

        $categories = Category::all();

        $products = Product::when($categoryId, function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        })
        ->when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })
        ->paginate(12);

        return view('shop', compact('categories', 'products'));
    }

    public function showProduct($id)
{
    $product = Product::findOrFail($id);
    return view('product.show', compact('product'));
}

}

