@extends('layouts.app_back')
@section('pageTitle','Edit Categories')
@section('content')
<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
            <h3>Update Category</h3>
                <form action="{{route('category.update', $category->id)}}" method="post">
                    @csrf
                    @method('PATCH')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$category->name}}">
                </div>
                <button type="submit" class="btn btn-info mt-3">Submit</button>
                </form>
        </div>
    </div>
</div>
@endsection