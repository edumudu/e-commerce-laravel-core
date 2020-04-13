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

Route::group(['middleware' => ['apiJwt']], function(){
  Route::post('auth/logout', 'Api\\AuthController@logout');
  Route::post('auth/refresh', 'Api\\AuthController@refresh');
  Route::post('auth/me', 'Api\\AuthController@me');

  Route::apiResources([
    'genre' => 'Api\\GenreController',
    'tipe'  => 'Api\\TipeController',
    'product'  => 'Api\\ProductController',
  ]);
});

