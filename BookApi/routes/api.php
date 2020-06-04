<?php

Route::get('users', 'UserController@index');
Route::post('user', 'UserController@store');
Route::get('user/{user_id}', 'UserController@show');
Route::patch('user/{user}/edit', 'UserController@update');
Route::delete('user/{user}', 'UserController@destroy');
