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

  Route::apiResource('product', 'ProductController')->only(['index', 'show']);
  Route::apiResource('review', 'ReviewController')->only(['index', 'show']);
  Route::apiResource('genre', 'GenreController')->only(['index', 'show']);
  Route::apiResource('category', 'CategoryController')->only(['index', 'show']);

  Route::group(['middleware' => ['apiJwt']], function(){

    Route::prefix('auth')->group(function(){
      Route::post('/logout', 'AuthController@logout');
      Route::post('/refresh', 'AuthController@refresh');
      Route::get('/me', 'AuthController@me');
    });
    
    Route::group(['middleware' => ['moderation']], function(){
      Route::post('product/{product}', 'ProductController@update')->name('product.update'); // To fix php bug in multipart/form-data in put method
      Route::apiResource('product', 'ProductController')->only(['store', 'destroy']);
    });

    Route::apiResource('review', 'ReviewController')->only(['store', 'update', 'destroy']);

    Route::apiResource('genre', 'GenreController')->except(['index', 'show']);
    Route::apiResource('category', 'CategoryController')->except(['index', 'show']);
  });

});
