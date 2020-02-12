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
Auth::routes();

Route::get('/', ['as' => 'site.home', 'uses' => 'Site\HomeController@index']);
Route::get('/contato', ['as' => 'site.contact', 'uses' => 'Site\ContactController@index']);
Route::get('/sobre', ['as' => 'site.about', 'uses' => 'Site\AboutController@index']);
Route::get('/produtos', ['as' => 'site.products', 'uses' => 'Site\ProductController@index']);
Route::get('/produtos/{id}', ['as' => 'site.products.single', 'uses' => 'Site\ProductController@single_prod']);

Route::get('/cart', ['as' => 'site.cart', 'uses' => 'Site\CartController@execute']);

// Disponiveis para qulquer um logado
Route::group(['middleware' => 'auth'], function(){
    Route::get('/whitelist', ['as' => 'site.whitelist', 'uses' => 'Site\UserController@whitelist']);
});

Route::group(['middleware' => 'admin'], function(){
    Route::get('/dashboard', ['as' => 'panel', 'uses' => 'Dashboard\DashboardController@index']);

    Route::resources([
        '/panel/products' => 'Dashboard\ProductController'
    ]);
});

// EOF
