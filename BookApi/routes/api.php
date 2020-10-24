<?php


Route::group(['middleware' => ['api']], function () {
	Route::prefix('auth')->group(function () {
		//users Api
		Route::get('users', 'UserController@index');
		Route::post('user/register', 'UserController@store');
		Route::get('user/{user_id}', 'UserController@show');
		Route::patch('user/{user}/edit', 'UserController@update');
		Route::delete('user/{user}', 'UserController@destroy');
		Route::patch('user/password/{user_id}', 'UserController@updatePassword');
		Route::post('user/update/{user_id}', 'UserController@updateUser');
	});

	Route::post('{slug}/checkin', 'Account\BookingController@checkIn');

	Route::prefix('account')->group(function () {
		Route::get('videos', 'Account\VideoController@getVideoByType');
		Route::post('watch/video/{video}', 'Activity\ActivityController@watchedVideo');
		Route::post('manage/favorite/{video}', 'Activity\ActivityController@manageFavorite');


		Route::prefix('booking')->group(function () {
			Route::post('join/subscription', 'Account\BookingController@joinWithSubscription');
			Route::post('join/ticket', 'Account\BookingController@joinWithTicket');
			Route::post('cancel', 'Account\BookingController@leave');
		});
	});
});
