@extends('layouts.app_back')
@section('pageTitle','Add New Products')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <h3>Add New Product</h3>
            <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="description">
              </div>
              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="price">
              </div>
              <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control">
                  <option value="">Select Category</option>
                  @forelse ($category as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                  @empty

                  @endforelse
                </select>
              </div>
              <div class="form-group">
                <label for="image_url">Image</label>
                <input type="file" class="form-control" id="image_url" name="image_url">
              </div>
              <button type="submit" class="btn btn-info mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection