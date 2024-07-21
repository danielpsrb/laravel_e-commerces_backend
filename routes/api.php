<?php

use App\Http\Controllers\Api\AuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/seller/register', [AuthenticationController::class, 'signupSeller']);

//register buyer
Route::post('/buyer/register', [AuthenticationController::class, 'signupBuyer']);

//login
Route::post('/login', [AuthenticationController::class, 'login']);

//logout
Route::post('/logout', [AuthenticationController::class, 'logout']);
