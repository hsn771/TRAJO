 @extends('layouts.backend')
@section('page_title',"Category Add")
@section('content')

<form action="{{route('customer.store')}}" method="post">
    @csrf
    <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
   <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}">
        </div>
    <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" name="password" class="form-control" value="{{ old('password') }}">
        </div>
   <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>
     <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>
    <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" class="form-control" value="{{ old('city') }}">
        </div>
    <div class="mb-3">
            <label class="form-label">District</label>
            <input type="text" name="district" class="form-control" value="{{ old('district') }}">
        </div>
   <div class="mb-3">
            <label class="form-label">Post Code</label>
            <input type="text" name="post_code" class="form-control" value="{{ old('post_code') }}">
        </div>
    <div>
       <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
      </div>
</form>
@endsection