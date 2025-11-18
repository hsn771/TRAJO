@extends('layouts.app_back')
@section('pageTitle', 'Edit Products')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">

        <div class="row">
            <h3>Update Product</h3>

            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Product Name -->
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" 
                           name="name" value="{{ $product->name }}" placeholder="Name">
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" 
                           name="description" value="{{ $product->description }}" placeholder="Description">
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" 
                           name="price" value="{{ $product->price }}" placeholder="Price">
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($category as $c)
                            <option value="{{ $c->id }}" 
                                @if ($c->id == $product->category_id) selected @endif>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Main Image -->
                <div class="form-group mt-3">
                    <label for="image_url">Main Image</label><br>

                    @if($product->image_url)
                        <img src="{{ asset('uploads/'.$product->image_url) }}" 
                             alt="Product Image" width="120" class="mb-2">
                    @endif

                    <input type="file" class="form-control" id="image_url" name="image_url">
                </div>

                <!-- Gallery Images -->
                <div class="form-group mt-4">
                    <label>Current Gallery Images</label><br>

                    @if(!empty($product->gallery_images))
                        <div class="d-flex flex-wrap">
                            @foreach($product->gallery_images as $img)
                                <div class="m-2 text-center">
                                    <img src="{{ asset('uploads/gallery/'.$img) }}" 
                                         width="100" height="100" style="object-fit:cover;">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No gallery images uploaded.</p>
                    @endif
                </div>

                <!-- Upload New Gallery Images -->
                <div class="form-group mt-3">
                    <label for="gallery_images">Add More Gallery Images</label>
                    <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple>
                    <small class="text-muted">You can upload additional images.</small>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-info mt-4">Update Product</button>

            </form>
        </div>

    </div>
</div>

@endsection
