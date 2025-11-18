@extends('layouts.app_back')
@section('pageTitle','Add New Products')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">

        <div class="row">
            <h3>Add New Product</h3>

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name">
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Product Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter product description">
                </div>

                <!-- Price -->
                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($category as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Main Image -->
                <div class="form-group mt-3">
                    <label for="image_url">Main Image</label>
                    <input type="file" class="form-control" id="image_url" name="image_url">
                    <small class="text-muted">This is the main product image.</small>
                </div>

                <!-- Gallery Images -->
                <div class="form-group mt-3">
                    <label for="gallery_images">Gallery Images (Upload 2–3 images)</label>
                    <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple>
                    <small class="text-muted">You can select multiple images.</small>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-info mt-4">Submit</button>
            </form>

        </div>

    </div>
</div>

@endsection
