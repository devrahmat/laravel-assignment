<?php

use App\Http\Controllers\productController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/products');
});
Route::get('/products',[productController::class,'products'])->name('products');
Route::get('/products/create',[productController::class,'addNewProduct'])->name('product.create');
Route::get('/products/{id}',[productController::class,'showProduct'])->name('product.show');
Route::post('/products',[productController::class,'productStore'])->name('product.store');
Route::get('/products/{id}/edit',[productController::class,'editProduct'])->name('product.edit');
Route::put('/products/{id}',[productController::class,'updateProduct'])->name('product.update');
Route::Delete('/products/{id}',[productController::class,'deleteProduct'])->name('product.destroy');
