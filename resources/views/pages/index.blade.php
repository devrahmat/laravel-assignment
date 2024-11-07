@extends('layout.app')
@section('content')

<div class="container-fluid w-75 mt-3">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-4">
                            <h2>Manage <b>Products</b></h2>
                            <div class="sorting-links">
                                Sort By :
                                <a href="{{ route('products', ['sort' => 'name', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">
                                        Name
                                        @if ($sortBy == 'name')
                                            @if ($direction == 'asc')
                                                ↑
                                            @else
                                                ↓
                                            @endif
                                        @endif
                                    </a>

                                        <a href="{{ route('products', ['sort' => 'price', 'direction' => $direction == 'asc' ? 'desc' : 'asc']) }}">
                                            Price
                                            @if ($sortBy == 'price')
                                                @if ($direction == 'asc')
                                                    ↑
                                                @else
                                                    ↓
                                                @endif
                                            @endif
                                        </a>

                            </div>
                        </div>
                        <div class="col-sm-4">
                            <form action="{{ route('products') }}" method="get">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search','') }}">
                                    <div class="input-group-btn border">
                                    <button class="btn btn-default" type="submit">
                                        <span class="material-icons">search</span>
                                    </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('product.create') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
                        </div>
                    </div>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr class="bg-light">
                            <th>SL</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>price</th>
                            <th>Stock</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->serial_number  }}</td>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    @if($product->image)
                                            <img class="product-thumbnail" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="30px">
                                        @else
                                            No image
                                    @endif
                                    @if($product->image)
                                        <img class="hover-image" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="250px">
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('product.show',$product->id) }}" class="edit"><i class="material-icons"  title="View">visibility</i></a>
                                    <a href="{{ route('product.edit',$product->id) }}" class="edit"><i class="material-icons"  title="Edit">&#xE254;</i></a>
                                    <form action="{{ route('product.destroy',$product->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this product?')";>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete" style="color: red;border: none;background-color: unset;">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                @if ($products->hasPages())
                {{ $products->links('pagination::bootstrap-4') }}
                @endif
            </div>
        </div>
    </div>
</div>


@endsection
