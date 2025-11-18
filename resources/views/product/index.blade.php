@extends('layouts.app_back')
@section('pageTitle', 'Products')
@section('content')

<div class="body-wrapper-inner">
    <div class="container-fluid">

        <div class="row">
            <h2>Products</h2>
            <a class="btn btn-info mb-3" href="{{ route('product.create') }}">Add New</a>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Name</th>
                        <th width="25%">Description</th>
                        <th width="10%">Price</th>
                        <th width="15%">Category</th>
                        <th width="20%">Images</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $i => $d)
                        <tr>
                            <td>{{ ++$i }}</td>

                            <td>{{ $d->name }}</td>

                            <td>{{ $d->description }}</td>

                            <td>{{ $d->price }}</td>

                            <td>{{ $d->categories?->name }}</td>

                            <td>
                                <!-- Main Image -->
                                @if($d->image_url)
                                    <img src="{{ asset('uploads/'.$d->image_url) }}" 
                                         width="70" height="70" 
                                         style="object-fit:cover; border-radius:5px;" 
                                         class="mr-2 mb-1">
                                @endif

                                <!-- Gallery Images (first 2 only) -->
                                @if(!empty($d->gallery_images))
                                    @foreach(array_slice($d->gallery_images, 0, 2) as $img)
                                        <img src="{{ asset('uploads/gallery/'.$img) }}" 
                                             width="70" height="70"
                                             style="object-fit:cover; border-radius:5px;" 
                                             class="mr-2 mb-1">
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                <!-- Edit Button -->
                                <a class="btn btn-info" href="{{ route('product.edit', $d->id) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- Delete Form -->
                                <form method="POST" action="{{ route('product.destroy', $d->id) }}" 
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this product?')">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No Data Found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection
