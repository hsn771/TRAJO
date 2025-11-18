<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return view('product.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->except('gallery_images');

        /** Save Main Image */
        if ($request->hasFile('image_url')) {
            $fileName = time() . '.' . $request->image_url->extension();
            $request->image_url->move(public_path('uploads'), $fileName);
            $input['image_url'] = $fileName;
        }

        /** Create Product */
        $product = Product::create($input);

        /** Save Gallery Images */
        $gallery = [];

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $img) {
                $imgName = time() . '_' . $img->getClientOriginalName();
                $img->move(public_path('uploads/gallery'), $imgName);
                $gallery[] = $imgName;
            }
        }

        $product->gallery_images = $gallery;
        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Display the specified product (Product Details Page).
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::all();
        return view('product.edit', compact('category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $input = $request->except(['image_url', 'gallery_images']);
        $product->update($input);

        /** Update Main Image */
        if ($request->hasFile('image_url')) {

            // Delete old image
            if ($product->image_url && file_exists(public_path('uploads/' . $product->image_url))) {
                unlink(public_path('uploads/' . $product->image_url));
            }

            $fileName = time() . '_' . $request->file('image_url')->getClientOriginalName();
            $request->file('image_url')->move(public_path('uploads'), $fileName);
            $product->image_url = $fileName;
        }

        /** Add New Gallery Images */
        $existingGallery = $product->gallery_images ?? [];
        $newGallery = [];

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $img) {
                $imgName = time() . '_' . $img->getClientOriginalName();
                $img->move(public_path('uploads/gallery'), $imgName);
                $newGallery[] = $imgName;
            }
        }

        // Merge old + new
        $product->gallery_images = array_merge($existingGallery, $newGallery);

        $product->save();

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        /** Delete main image */
        if ($product->image_url && file_exists(public_path('uploads/' . $product->image_url))) {
            unlink(public_path('uploads/' . $product->image_url));
        }

        /** Delete gallery images */
        if (!empty($product->gallery_images)) {
            foreach ($product->gallery_images as $img) {
                $path = public_path('uploads/gallery/' . $img);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
        }

        $product->delete();

        return redirect()->back();
    }
}
