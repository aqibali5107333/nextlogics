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

Route::get('/', function () {
    return view('welcome');
});

// press ctrl+b or ctrl+click
Route::get('users', 'UserController@index');
Route::get('users/create', 'UserController@create');
Route::post('users', 'UserController@store');
Route::get('users/{id}/edit', 'UserController@edit');
Route::get('users/{id}', 'UserController@show');
Route::delete('users/{id}', 'UserController@destroy');
Route::put('users/{id}', 'UserController@update');

Route::resource('users', 'UserController');

Route::get('charge', 'ChargeController@index');
Route::post('charge', 'ChargeController@store');