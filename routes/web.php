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
Route::post('logout', 'LoginController@logout');
Route::get('home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
	
	//Admin
	Route::group(['middleware' => 'admin'], function(){
		Route::get('user', 'UserController@index');
		Route::post('user/update', 'UserController@update')->name('update');
		Route::post('user/active', 'UserController@active');
		Route::delete('user/delete', 'UserController@delete');

		Route::get('file', 'FileController@index');
	});
	
	//User
	Route::group(['middleware' => 'user'], function(){
		Route::get('labeling', 'LabelingController@fileLabeling');
		Route::get('labeling/corpus', 'LabelingController@corpus');
		Route::get('labeling/label/{id}', 'LabelingController@label');
	});
	
	//Revisor
});
Route::get('layout', function (){
    return view('layout');
});
Route::get('home', function (){
    return view('home');
});

