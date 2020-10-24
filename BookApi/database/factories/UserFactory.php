<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Role;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'user_id' => Str::uuid(),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'password',
        'remember_token' => Str::random(10),

//	    'role_id' => function () {
//		    return Role::all()->random();
//	    },
    ];
});
