@extends('layouts.customer')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer Dashboard</div>
                <div class="card-body">
                    Welcome, {{ auth()->guard('customer')->user()->name }}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
