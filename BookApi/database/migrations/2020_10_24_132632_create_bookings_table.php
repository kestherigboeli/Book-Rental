<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->dateTime('start_date')->nullable();
	        $table->dateTime('end_date')->nullable();
	        $table->integer('status')->default('Confirmed')->index(); // 0 pending, 1 confirmed, 2 attended, 3 waiting
	        $table->unsignedBigInteger('studio_id')->nullable()->index();
	        $table->unsignedBigInteger('schedule_id')->nullable()->index();
	        $table->unsignedBigInteger('user_id')->nullable()->index();
	        $table->timestamps();
	        $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
	        $table->foreign('studio_id')->references('id')->on('studios')->onDelete('cascade');
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
