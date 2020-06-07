<?php

Route::get('users', 'UserController@index');
Route::post('user/register', 'UserController@store');
Route::get('user/{user_id}', 'UserController@show');
Route::patch('user/{user}/edit', 'UserController@update');
Route::delete('user/{user}', 'UserController@destroy');


Route::group([

	'middleware' => 'api',
	'prefix' => 'auth'

], function () {

	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');
	Route::post('refresh', 'AuthController@refresh');
	Route::post('me', 'AuthController@me');

});
