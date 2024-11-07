@extends('layout.app')
@section('content')

<!-- Add Employee -->
<div class="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add Product</h5>
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </div>
            <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="form-group">
                                <label for="productName">Product Title</label>
                                <input type="text" class="form-control" name="name" id="productName" placeholder="Enter Product Name" value="{{old('name')}}">
                            </div>
                            <div class="form-group"style="margin-top:20px;">
                                <label for="productID">Product ID</label>
                                <input type="text" class="form-control" name="product_id" id="productID" placeholder="Enter Product ID" value="{{old('product_id')}}">
                            </div>
                            @error('product_id')
                                <div class="error" style="color:red;">{{ $message }}</div>
                            @enderror
                            <div class="form-group" style="margin:20px 0px;">
                                <label for="productDescription">Product Description</label>
                                <textarea  class="form-control" name="description" id="productDescription" placeholder="Product Description"> {{old('description')}}</textarea>
                            </div>
                            <div class="col">
                                <label for="price">Price</label>
                                <input type="number" step=any id="price" name="price" class="form-control" placeholder="10.00" value="{{old('price')}}">
                                @error('price')
                                <div class="error" style="color:red;">{{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col">
                                <label for="stock">Stock</label>
                                <input type="text" name="stock" id="stock" class="form-control" placeholder="50" value="{{old('stock')}}">
                            </div>
                            <div class="custom-file" style="margin-top: 20px;">
                                <label for="image">Product Image</label>
                                <input type="file" class="custom-file-input" name="image" id="image">
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Add Product</button>

                    </div>
                </div>


            </form>
        </div>
    </div>
</div>


@endsection
