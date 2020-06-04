<?php

Route::get('users', 'UserController@index');
Route::post('users', 'UserController@store');
Route::get('user/{user_id}', 'UserController@show');
