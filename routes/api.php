<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// User Register and Login
Route::post('register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [App\Http\Controllers\Api\AuthController::class, 'login']);


// Update User Profile
Route::middleware('auth:api')->prefix('/user')->group(function() {
    Route::post('logout',[App\Http\Controllers\Api\AuthController::class, 'logout']);
});

Route::middleware('auth:api')->group(function() {
    Route::post('create-user',[App\Http\Controllers\Api\UserInfoController::class, 'createUser']);
    Route::get('user-list',[App\Http\Controllers\Api\UserInfoController::class, 'userList']);
    Route::get('user-details/{id}',[App\Http\Controllers\Api\UserInfoController::class, 'userDetails']);
});
