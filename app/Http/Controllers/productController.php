<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    function products(Request $request){

        $sortBy = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');

       $data = $request['search'];
       $products = Product:: where('product_id','like',"%{$data}%")
       ->orWhere('name','like',"%{$data}%")
       ->orWhere('description','like',"%{$data}%")->orderBy($sortBy, $direction)->paginate(5);

       $products->getCollection()->transform(function ($item, $key) use ($products) {
            $item->serial_number = $key + 1 + ($products->currentPage() - 1) * $products->perPage();
            return $item;
        });

       return view('pages.index', compact('products', 'sortBy', 'direction'));

    }




function addNewProduct(){
    return view('pages.create');
}


function showProduct(Request $request){
    $id = $request->id;
    $product = Product::findOrFail($id);
    return view('pages.showProduct', compact('product'));
}



function productStore(Request $request){

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|unique:products,product_id',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()->with('error', 'Something Wrong! Fix the form errors');;
        }

    $image = null;
    if ($request->hasFile('image')) {
        $originalFilename = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $timestamp = time();
        $filename = $originalFilename . '-' . $timestamp . '.' . $extension;
        $image = $request->file('image')->storeAs('images', $filename, 'public');
    }

    Product::create([
        'product_id'=>$request['product_id'],
        'name'=>$request['name'],
        'description'=>$request['description'],
        'price'=>$request['price'],
        'stock'=>$request['stock'],
        'image'=>$image
    ]);

    return redirect()->route('products')->with('success', 'Product Added successfully.');
}



function editProduct( Request $request){
    $id = $request->id;
    $product = Product::findOrFail($id);
    return view('pages.edit', compact('product'));
}



public function updateProduct(Request $request)
{
    $id = $request->id;
    $validator = Validator::make($request->all(), [
        'product_id' => 'required|unique:products,product_id,' . $id,
        'price' => 'required',
    ]);
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()->with('error', 'Something Wrong! Fix the form errors');
    }


    $product = Product::findOrFail($id);

    $image = $product->image; // Default to existing image path
    if ($request->hasFile('image')) {
        // Delete old image if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Store the new image with a unique name
        $originalFilename = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $timestamp = time();
        $filename = $originalFilename . '-' . $timestamp . '.' . $extension;
        $image = $request->file('image')->storeAs('images', $filename, 'public'); // Stores in 'public/images'
    }

    // Update product with new data
    $product->update([
        'product_id' => $request['product_id'],
        'name' => $request['name'],
        'description' => $request['description'],
        'price' => $request['price'], // Assuming 'price' is the actual column name in the DB
        'stock' => $request['stock'],
        'image' => $image,
    ]);

    return redirect()->route('products')->with('success', 'Product updated successfully.');
}



function deleteProduct(Request $request){

    $id = $request->id;
    $product = Product::findOrFail($id);
    if ($product->image) {
        // Delete the image from storage
        Storage::disk('public')->delete($product->image);
    }
    $product->delete();

    return redirect()->back()->with('success', 'Product ' . $product->name .' Deleted successfully.');
}


}
