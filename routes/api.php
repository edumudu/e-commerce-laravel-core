<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->group(function(){

  Route::post('auth/login', 'AuthController@login');
  Route::post('auth/register', 'AuthController@register');

  Route::post('/contact', 'UserContactController@contact');

  Route::apiResource('product', 'ProductController')->only(['index', 'show']);
  Route::apiResource('review', 'ReviewController')->only(['index', 'show']);
  Route::apiResource('genre', 'GenreController')->only(['index', 'show']);
  Route::apiResource('category', 'CategoryController')->only(['index', 'show']);

  Route::prefix('cart')->name('cart.')->group(function(){
    Route::post('/info', 'CartController@info')->name('info');
  });

  Route::middleware('apiJwt')->group(function(){

    Route::prefix('auth')->group(function(){
      Route::post('/logout', 'AuthController@logout');
      Route::post('/refresh', 'AuthController@refresh');
      Route::get('/me', 'AuthController@me');
    });

    Route::prefix('checkout')->group(function(){
      Route::get('/sessionId', 'CheckoutController@makePagSeguroSession');
      Route::post('/process', 'CheckoutController@process');
    });
    
    Route::middleware('moderation')->group(function(){
      Route::post('/product/{product}', 'ProductController@update')->name('product.update'); // To fix php bug in multipart/form-data in put method
      Route::apiResource('product', 'ProductController')->only(['store', 'destroy']);
      Route::apiResource('user', 'UserController')->only('index');
      Route::get('/user/info', 'UserController@info');
    });

    Route::apiResource('review', 'ReviewController')->only(['store', 'update', 'destroy']);

    Route::apiResource('genre', 'GenreController')->except(['index', 'show']);
    Route::apiResource('category', 'CategoryController')->except(['index', 'show']);
  });

});
