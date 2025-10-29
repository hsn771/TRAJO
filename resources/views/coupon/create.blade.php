@extends('layouts.app_back')
@section('pageTitle','Add New Coupon')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <h3>Add New Coupon</h3>
            <form action="{{route('coupon.store')}}" method="post">
                @csrf
              <div class="form-group">
                <label for="code">Code</label>
            <input type="text"  name="code"  class="form-control form-control-rounded" id="code">
              </div>
              <div class="form-group">
                <label for="discount_type">Discount Type</label>
            <select name="discount_type"  class="form-control form-control-rounded" id="discount_type">
                <option value="1">Percentage</option>
                <option value="2">Fixed Amount</option>
            </select>
              </div>
              <div class="form-group">
                <label for="discount_value">Discount Value</label>
                <input type="text" name="discount_value" class="form-control form-control-rounded" id="discount_value" >
              </div>
              <div class="form-group">
                 <label for="usage_limit">Usage Limit</label>
                 <input type="text"  name="usage_limit"  class="form-control form-control-rounded" id="usage_limit">
              </div>
              <div class="form-group">
                <label for="min_order_amount">Min Order Amount</label>
                <input type="text"  name="min_order_amount"  class="form-control form-control-rounded" id="min_order_amount">
              </div>
              div class="form-group">
            <label for="start_date">Start Date</label>
            <input type="date"  name="start_date"  class="form-control form-control-rounded" id="start_date">
           </div>


           <div class="form-group">
            <label for="end_date">End Date</label>
            <input type="date"  name="end_date"  class="form-control form-control-rounded" id="end_date">
           </div>


           <div class="form-group">
            <label for="is_active">Is Active</label>
            <select name="is_active" id="is_active" class="form-control form-control-rounded">
                <option value="0">Inactive</option>
                <option value="1">Active</option>
            </select>
           </div>
              <button type="submit" class="btn btn-info mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>


@endsection