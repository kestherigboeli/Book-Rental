<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->string('role')->index()->default('Customer');
			$table->string('phone', 25)->nullable();
			$table->date('birth_date')->nullable();
			$table->text('photo')->nullable();
			$table->integer('mobile_marketing')->nullable();
			$table->integer('email_marketing')->nullable();
			$table->timestamp('sanctioned_until')->nullable()->index();
			$table->boolean('external')->default(false);
			$table->rememberToken();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}

