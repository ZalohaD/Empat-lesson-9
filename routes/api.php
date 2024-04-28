<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api as Controllers;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('/auth')->name('auth.')->controller(Controllers\AuthContoller::class)->group(function() {

    Route::post('/register', 'register')->name('register');

    Route::post('/login', 'login')->name('login');

});

Route::prefix('/products')->name('products.')->middleware('auth:api')->controller(Controllers\ProductController::class)->group(function() {

    Route::get('/','productsList')->name('productsList');

    Route::get('/{id}','productShow')->name('productShow');

});
