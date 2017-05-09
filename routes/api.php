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

Route::post('storeCategory', 'CategoryController@storeCategory');
Route::post('updateCategory/{id}', 'CategoryController@updateCategory');
Route::get('showCategory/{id}', 'CategoryController@showCategory');
Route::post('deleteCategory/{id}', 'CategoryController@deleteCategory');

Route::post('storeProduct', 'ProductController@storeProduct');
Route::post('updateProduct/{id}', 'ProductController@updateProduct');
Route::get('showProduct/{id}', 'ProductController@showProduct');
Route::post('deleteProduct/{id}', 'ProductController@deleteProduct');

Route::get('storeRole', 'RoleController@storeRole');
Route::post('updateRole/{id}', 'RoleController@updateRole');
Route::get('showRole/{id}', 'RoleController@showRole');
Route::post('deleteRole/{id}', 'RoleController@deleteRole');

Route::post('storeUser', 'UserController@storeUser');
Route::post('signIn', 'UserController@signIn');
Route::post('updateUser/{id}', 'UserController@updateUser');
Route::get('showUser/{id}', 'UserController@showUser');
Route::post('deleteUser/{id}', 'UserController@deleteUser');
Route::get('indexUsers', 'UserController@indexUsers');

Route::post('placeOrder', 'OrderController@placeOrder');
Route::post('cancelOrder/{id}', 'OrderController@cancelOrder');
Route::post('updateOrder/{id}', 'OrderController@updateOrder');
Route::get('showOrder/{id}', 'OrderController@showOrder');
Route::get('orderIndex', 'OrderController@orderIndex'); 


Route::any('{path?}', 'MainController@index')->where("path", ".+");
