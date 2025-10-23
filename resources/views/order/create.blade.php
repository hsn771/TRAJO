{{-- @extends('layouts.app_back')
@section('pageTitle','Add New Products')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <h3>Add New Product</h3>
            <form action="{{route('order.store')}}" method="post" enctype="multipart/form-data">
                @csrf
             <div class="form-group">
                <label for="coupon_id">Coupon</label>
                <select name="coupon_id" class="form-control">
                  <option value="">Select Coupon</option>
                  @forelse ($coupon as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                  @empty

                  @endforelse
                </select>
              </div>
              <div class="form-group">
                <label for="total_price">Total Price</label>
                <input type="text" class="form-control" id="total_price" name="total_price" placeholder="Total Price">
              </div>
              <div class="form-group">
                <label for="final_price">Final Price</label>
                <input type="text" class="form-control" id="final_price" name="final_price" placeholder="Final Price">
              </div>
              
              <div class="form-group">
               <label for="district_id">District</label>
                            <select name="district_id" class="form-control" id="district">
                                <option selected>Select your district</option>
                                @foreach($districts as $district)
                                    <option class="dist dist{{$district->division_id}}" value="{{ $district->id }}">{{ $district->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('district_id'))
                                <span class="text-danger"> {{ $errors->first('district_id') }}</span>
                            @endif
              </div>
              <div class="form-group">
               <label for="division_id">Division</label>
                            <select name="division_id" class="form-control" id="division" onchange="fetchDistricts(this.value)">
                                <option selected>Select your division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('division_id'))
                                <span class="text-danger"> {{ $errors->first('division_id') }}</span>
                            @endif
              </div>
              <div class="form-group">
                <label for="notes">Notes</label>
                <input type="text" class="form-control" id="notes" name="notes" placeholder="Notes">
              </div>
              <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address">
              </div>
              <div class="form-group">
                <label for="user_id">User</label>
                <select name="User_id" class="form-control">
                  <option value="">Select User</option>
                  @forelse ($user as $c)
                      <option value="{{$c->id}}">{{$c->name}}</option>
                  @empty

                  @endforelse
                </select>
              </div>
              <button type="submit" class="btn btn-info mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection --}}