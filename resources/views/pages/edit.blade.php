@extends('layout.app')
@section('content')

<!-- Add Employee -->
<div class="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </div>
            <form action="{{ route('product.update',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">Product Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Product ID</label>
                                    <input type="text" class="form-control" name="product_id" value="{{ $product->product_id }}">
                                </div>
                                @error('product_id')
                                    <div class="error" style="color:red;">{{ $message }}</div>
                                @enderror
                                <div class="col-12 p-1">
                                    <label class="form-label">Product Description</label>
                                    <input type="text" class="form-control" name="description" value="{{ $product->description }}">
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ $product->price }}">
                                    @error('price')
                                        <div class="error" style="color:red;">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 p-1">
                                    <label class="form-label">Stock</label>
                                    <input type="text" class="form-control" name="stock" value="{{ $product->stock }}">
                                </div>
                                <div class="col-12 p-1">
                                    <label for="image">Current Image</label>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="300px">
                                    @else
                                        No image
                                    @endif
                                </div>
                                <div class="col-12 p-1">
                                    <label for="image">Select New Image</label>
                                <input type="file" class="custom-file-input" name="image" id="image">
                                </div>

                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
