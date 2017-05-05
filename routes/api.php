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
/*
Route::post('storeCategory');
Route::post('updateCategory');
Route::get('showCategory');
Route::post('deleteCategory');

Route::post('storeProduct');
Route::post('updateProduct');
Route::get('showProduct');
Route::post('deleteProduct');


Route::('indexRoles');
Route::get('storeRole');
Route::post('updateRole');
Route::get('showRole');
Route::post('deleteRole/{id}', 'RoleController@deleteRole');

Route::post('storeUser', 'UserController@storeUser');
Route::post('signIn', 'UserController@signIn');
Route::('userIndex');
Route::post('updateUser');
Route::get('showUser');
Route::post('deleteUser');
*/





Route::any('{path?}', 'MainController@index')->where("path", ".+");
