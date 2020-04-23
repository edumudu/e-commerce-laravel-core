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

Route::post('auth/login', 'Api\\AuthController@login');

Route::apiResource('product', 'Api\\ProductController')->only(['index', 'show']);
Route::apiResource('review', 'Api\\ReviewController')->only(['index', 'show']);

Route::group(['middleware' => ['apiJwt']], function(){
  Route::post('auth/logout', 'Api\\AuthController@logout');
  Route::post('auth/refresh', 'Api\\AuthController@refresh');
  Route::get('auth/me', 'Api\\AuthController@me');
  
  Route::group(['middleware' => ['moderation']], function(){
    Route::post('product/{id}', 'Api\\ProductController@update'); // To fix php bug in multipart/form-data in put method
    Route::apiResource('product', 'Api\\ProductController')->only(['store', 'destroy']);
  });

  Route::apiResource('review', 'Api\\ReviewController')->only(['store', 'update', 'destroy']);

  Route::apiResources([
    'genre' => 'Api\\GenreController',
    'tipe'  => 'Api\\TipeController',
  ]);
});

