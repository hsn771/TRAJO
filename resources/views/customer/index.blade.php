@extends('layouts.backend')
@section('page_title',"Customer Add")
@section('content')
  
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">
                Customer
                <a class="btn btn-primary float-right" href="{{route('customer.create')}}"> Add New </a>
            </h4>
            <div class="single-table">
                <div class="table-responsive">
                    <table class="table table-hover progress-table text-center">
                        <thead class="text-uppercase">
                           <tr>
                                <th scope="col">#SL</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">City</th>
                                <th scope="col">District</th>
                                <th scope="col">Post_code</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $i=>$d)
                                <tr>
                                    <th scope="row">{{++$i}}</th>
                                    <td>{{$d->name}}</td>
                                    <td>{{$d->email}}</td>
                                    <td>{{$d->password}}</td>
                                    <td>{{$d->phone}}</td>
                                    <td>{{$d->address}}</td>
                                    <td>{{$d->city}}</td>
                                    <td>{{$d->district}}</td>
                                    <td>{{$d->post_code}}</td>
                                    <td>
                                       <ul class="d-flex justify-content-center">
                                            <li class="mr-3"><a href="{{route('customer.edit',$d->id)}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                            <li>
                                                <form method="post" action="{{route('customer.destroy',$d->id)}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-link"><i class="ti-trash"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>No Data Found</td>
                                </tr>
                            @endforelse
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Progress Table end -->
        @endsection