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
    return view('home');
});
//Login
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');
// Route::post('admin/logout', 'LoginController@logout');
Route::get('home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
	
	//Admin
	Route::group(['middleware' => 'admin'], function(){
		Route::get('statistical', function (){
		    return view('admin.statistical.statistical');
		});
		Route::get('users', 'UserController@index');
		Route::get('user', 'UserController@index');
		Route::post('user/update', 'UserController@update')->name('update');
		Route::post('user/active', 'UserController@active');
		Route::delete('user/delete', 'UserController@delete');

		Route::get('file', 'FileController@index');
		Route::post('file/edit', 'FileController@update');
	});
	
	//User
	Route::group(['middleware' => 'user'], function(){
		Route::get('labeling', 'LabelingController@fileLabeling');
		Route::get('labeling/corpus', 'LabelingController@corpus');
		Route::get('labeling/label/{id}', 'LabelingController@label');
		Route::post('labeling/label/save', 'LabelingController@save');

		Route::get('edit', 'EditLabelingController@index');
		Route::get('edit/label/{id}', 'EditLabelingController@edit');
		Route::post('edit/label/save', 'LabelingController@save');

	});
	
	//Revisor
});
Route::get('layout', function (){
    return view('layout');
});
Route::get('home', function (){
    return view('home');
});
Route::get('admin', function (){
    return view('admin.layout.admin-layout');
});
Route::get('bbb', function (){
    return view('member.labeling.label');
});