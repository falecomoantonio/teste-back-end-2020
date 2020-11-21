<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/refresh', [App\Http\Controllers\AuthController::class, 'refresh']);
    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'myProfile']);

});


Route::resource('products',App\Http\Controllers\ProductController::class,['only' => ['store','update','destroy']])->middleware('auth:api');
Route::resource('products',App\Http\Controllers\ProductController::class,['only' => ['index','show']]);
