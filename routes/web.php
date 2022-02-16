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

//Route::get('/', function () {
//    return view('login');
//});
//Route::get('/login', function () {
//    return view('login');
//})->name('login');

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('index');
Route::get('/login', 'App\Http\Controllers\HomeController@index')->name('index');
Route::get('/dashboard', 'App\Http\Controllers\UsersController@dashboard')->name('homepage');
Route::get('/users/childs/{type}', 'App\Http\Controllers\UsersController@index')->name('users.index');
Route::get('/users/add', 'App\Http\Controllers\UsersController@add')->name('users.add');
Route::get('/users/profile', 'App\Http\Controllers\UsersController@profile')->name('users.profile');
Route::get('/file-import',[App\Http\Controllers\UsersController::class,'importView'])->name('import-view');
Route::post('/import',[App\Http\Controllers\UsersController::class,'import'])->name('import');
Route::get('/export-users',[App\Http\Controllers\UsersController::class,'exportUsers'])->name('export-users');