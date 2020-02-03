<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'site.home', 'uses' => 'Site\HomeController@execute']);
Route::get('/contato', ['as' => 'site.contact', 'uses' => 'Site\ContactController@execute']);
Route::get('/sobre', ['as' => 'site.about', 'uses' => 'Site\AboutController@execute']);
Route::get('/produtos', ['as' => 'site.products', 'uses' => 'Site\ProductController@execute']);

Route::get('/cart', ['as' => 'site.cart', 'uses' => 'Site\CartController@execute']);

// Login
Route::get('/login', ['as' => 'login', 'uses' => 'Login\LoginController@execute']);
Route::post('/logar', ['as' => 'login.logar', 'uses' => 'Login\LoginController@login']);
Route::get('/logout', ['as' => 'login.logout', 'uses' => 'Login\LoginController@logout']);

// Disponiveis para qulquer um logado
Route::group(['middleware' => 'auth'], function(){
    Route::get('/whitelist', ['as' => 'site.whitelist', 'uses' => 'Site\UserController@whitelist']);
});