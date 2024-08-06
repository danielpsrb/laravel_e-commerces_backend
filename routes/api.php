<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//register seller
Route::post('/seller/register', [AuthenticationController::class, 'signupSeller']);

//register buyer
Route::post('/buyer/register', [AuthenticationController::class, 'signupBuyer']);

//login
Route::post('/login', [AuthenticationController::class, 'login']);

//logout
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');;

//category
Route::apiResource('/seller/category', 'App\Http\Controllers\Api\CategoryController::class')->middleware('auth:sanctum');

//get category by id
Route::get('seller/category/{id}', ['App\Http\Controllers\Api\CategoryController', 'show'])->middleware('auth:sanctum');

//product
Route::apiResource('/seller/products', 'App\Http\Controllers\Api\ProductController::class')->middleware('auth:sanctum');

//update product
Route::put('/seller/products/{id}', ['App\Http\Controllers\Api\ProductController', 'update'])->middleware('auth:sanctum');

//get product by id
Route::get('seller/products/{id}', ['App\Http\Controllers\Api\ProductController', 'show'])->middleware('auth:sanctum');

//address
Route::apiResource('/buyer/address', 'App\Http\Controllers\Api\AddressController::class')->middleware('auth:sanctum');
