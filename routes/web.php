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

// INDEX CONTROLLER
Route::get('/', 'IndexController@index')->name('index');
Route::get('/categories/{category}', 'IndexController@filter');


//AUTH CONTROLLERS
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->middleware('auth');


// CART CONTROLLER
Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/add/{id}', 'CartController@add');
Route::get('/cart/decrement/{id}', 'CartController@decrement');
Route::get('/cart/remove/{id}', 'CartController@remove');
Route::get('/cart/buy', 'CartController@buy');


//ADMIN CONTROLLER EDIT ACTIONS
Route::get('/edit/{id}', 'AdminController@edit');
Route::put('/edit', 'AdminController@update');


// ADMIN CONTROLLER ADMINISTRATION PANEL
Route::get('/admin', 'AdminController@admin')->name('admin');
Route::get('/admin/changeRights/{id}/{admin}', 'AdminController@changeRights');
Route::get('/admin/delete/{id}', 'AdminController@delete');

