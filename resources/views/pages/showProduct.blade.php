@extends('layout.app')
@section('content')

<!-- Add Employee -->
<div class="">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Product</h5>
                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
            </div>

                <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1 text-center">

                                    @if($product->image)
                                        <img style="max-width: 450px;" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    @else
                                        No image
                                    @endif
                                </div>
                                <div class="col-12 p-1">
                                    <p><b>Product Name : </b>{{ $product->name }}</p>
                                </div>
                                <div class="col-12 p-1">
                                    <p><b>Product ID : </b>{{ $product->product_id }}</p>
                                </div>
                                <div class="col-12 p-1">
                                    <p><b>Product Description :</b> {{ $product->description }}</p>
                                </div>
                                <div class="col-12 p-1">
                                    <p><b>Product Price :</b> {{ $product->price }}</p>
                                </div>
                                <div class="col-12 p-1">
                                    <p><b>Product Stock :</b> {{ $product->stock }}</p>
                                </div>

                            </div>
                        </div>

                </div>
        </div>
    </div>
</div>
