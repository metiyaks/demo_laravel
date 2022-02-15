<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', 'App\Http\Controllers\API\LoginmaterController@register');
Route::post('login', 'App\Http\Controllers\API\LoginmaterController@login');
Route::post('logout', 'App\Http\Controllers\API\LoginmaterController@logout')->name('logoutuser');

Route::middleware('auth:api')->group(function () {
    
    Route::post('users', 'App\Http\Controllers\API\UsersController@index');
    Route::post('users/profile', 'App\Http\Controllers\API\UsersController@profile');
    Route::post('users/edit', 'App\Http\Controllers\API\UsersController@edit');
    Route::post('getData', 'App\Http\Controllers\API\UsersController@getLoginData');
    Route::post('addUser', 'App\Http\Controllers\API\UsersController@storeUser');
    
    Route::post('export', 'App\Http\Controllers\API\UsersController@export');
    Route::post('users/createWPAccount', 'App\Http\Controllers\API\UsersController@createWp');
     
});