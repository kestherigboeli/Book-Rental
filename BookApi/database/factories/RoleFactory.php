<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
	$roles = [['name' => 'User'],
				['name' =>'Admin']];

	foreach ($roles as $role) {
		return [
			'name' => $role['name']
        ];
	}

});
