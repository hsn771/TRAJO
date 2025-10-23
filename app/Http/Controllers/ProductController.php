<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=product::all();
        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category=category::all();
        return view('product.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input=$request->all();
        if($request->hasFile('image_url')){
            $fileName = time().'.'.$request->image_url->extension();  
            $request->image_url->move(public_path('uploads'), $fileName);
            $input['image_url']=$fileName;
        }

        product::create($input);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        $category=category::all();
        return view('product.edit',compact('category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        $product->update($request->all());
        // return redirect()->route('product.index');

        if ($request->hasFile('image_url')) {
       
        if ($product->image_url && file_exists(public_path('uploads/'.$product->image_url))) {
            unlink(public_path('uploads/'.$product->image_url));
        }
        $fileName = time().'_'.$request->file('image_url')->getClientOriginalName();
        $request->file('image_url')->move(public_path('uploads'), $fileName);

        $product->image_url = $fileName;
    }

    $product->save();

    return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
