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

  Route::prefix('auth')->group(function(){
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/logout', 'AuthController@logout')->middleware('apiJwt');
    Route::get('/me', 'AuthController@me')->middleware('apiJwt');
  });

  Route::post('/contact', 'UserContactController@contact');

  Route::prefix('cart')->name('cart.')->group(function(){
    Route::post('/info', 'CartController@info')->name('info');
  });

  Route::post('/checkout/notification', 'CheckoutController@notification');

  Route::middleware('apiJwt')->group(function(){

    Route::prefix('checkout')->group(function(){
      Route::get('/sessionId', 'CheckoutController@makePagSeguroSession');
      Route::post('/process', 'CheckoutController@process');
    });

    Route::prefix('order')->group(function() {
      Route::get('/', 'UserOrderController@index');

      Route::middleware('moderation')->group(function(){
        Route::get('/info', 'UserOrderController@info');
      });
    });
    
    Route::middleware('moderation')->group(function(){
      Route::post('/product/{product}', 'ProductController@update')->name('product.update'); // To fix php bug in multipart/form-data in put method
      Route::apiResource('product', 'ProductController')->only(['store', 'destroy']);
      Route::apiResource('user', 'UserController')->only('index');

      Route::get('/user/info', 'UserController@info');
      Route::get('/genre/info', 'GenreController@info');
      Route::get('/category/info', 'CategoryController@info');
    });

    Route::apiResource('/{product}/review', 'ReviewController')->only(['store', 'update', 'destroy']);
    Route::apiResource('genre', 'GenreController')->except(['index', 'show']);
    Route::apiResource('category', 'CategoryController')->except(['index', 'show']);
  });

  Route::apiResource('product', 'ProductController')->only(['index', 'show']);
  Route::apiResource('review', 'ReviewController')->only(['index', 'show']);
  Route::apiResource('genre', 'GenreController')->only(['index', 'show']);
  Route::apiResource('category', 'CategoryController')->only(['index', 'show']);

});
