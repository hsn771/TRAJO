@extends('layouts.app_back')
@section('pageTitle',content: 'Edit Products')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <h3>Update Products</h3>
            <form action="{{route('product.update', $product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$product->name}}">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{$product->description}}">
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="price" value="{{$product->price}}">
              </div>
              <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control">
                  <option value="">Select Category</option>
                  @forelse ($category as $c)
                      <option value="{{$c->id}}" @if($c->id==$product->category_id) selected @endif>{{$c->name}}</option>
                  @empty

                  @endforelse
                </select>
              </div>
              <div class="form-group">
                <label for="image_url">Image</label>
                @if($product->image_url)
                    <img src="{{ asset('uploads/'.$product->image_url) }}" alt="Product Image" width="100" class="d-block mb-2">
                @endif
                <input type="file" class="form-control" id="image_url" name="image_url">
              </div>
              <button type="submit" class="btn btn-info mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection