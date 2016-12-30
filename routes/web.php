<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Login
Route::get('login', 'LoginController@show');
Route::post('login', 'LoginController@login');

//Home
Route::get('home', function(){
	return view('home');
});
//User
Route::get('user', 'UserController@index');
Route::post('user/update', 'UserController@update')->name('update');
Route::get('/home', 'HomeController@index');
Route::post('user/active', 'UserController@active');
Route::delete('user/delete', 'UserController@delete');
