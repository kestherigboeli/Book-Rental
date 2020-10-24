<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = ['User', 'Admin'];

    	foreach($roles as $role) {
		    \App\Role::create([
			    'name' => $role,
		    ]);
	    }
    }
}
