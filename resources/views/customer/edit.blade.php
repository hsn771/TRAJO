@extends('layouts.backend')
@section('page_title',"Customer Add")
@section('content')

<form action="{{route('customer.update',$customer->id)}}" method="post">
    @csrf
    @method('PATCH')
    <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="form-control">
        </div>
     <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" value="{{ old('email', $customer->email) }}" class="form-control">
        </div>
    <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="text" name="password" value="{{ old('password', $customer->password) }}" class="form-control">
        </div>
     <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="form-control">
        </div>
    <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" value="{{ old('address', $customer->address) }}" class="form-control">
        </div>
    <div class="mb-3">
            <label class="form-label">City</label>
            <input type="text" name="city" value="{{ old('city', $customer->city) }}" class="form-control">
        </div>
    <div class="mb-3">
            <label class="form-label">District</label>
            <input type="text" name="district" value="{{ old('district', $customer->district) }}" class="form-control">
        </div>
     <div class="mb-3">
            <label class="form-label">Post Code</label>
            <input type="text" name="post_code" value="{{ old('post_code', $customer->post_code) }}" class="form-control">
        </div>
    <div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('customer.index') }}" class="btn btn-secondary btn-danger">Cancel</a>
      </div>
</form>
@endsection