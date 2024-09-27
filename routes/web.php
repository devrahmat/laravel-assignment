<?php

use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile/{id}',[ProfileController::class,'index']);
