<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class BookTest extends TestCase
{
	use RefreshDatabase;
    /**
     *
     * @test
     */
    public function can_create_an_account()
    {

    	$user1 = new UserController();

	    $user = factory(User::class)->create();


	    $this->assertEquals($user, $user1->index());
    }
}
