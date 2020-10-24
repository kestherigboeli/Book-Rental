<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
	        $table->bigIncrements('id');
	        $table->string('name')->nullable();
	        $table->text('description')->nullable();
	        $table->string('slug')->unique();
	        $table->dateTime('start_date');
	        $table->dateTime('end_date')->nullable();
	        $table->integer('capacity')->default(0);
	        $table->integer('available')->default(0);
	        $table->integer('duration')->default(0);
	        $table->unsignedBigInteger('studio_id')->nullable()->index();
	        $table->unsignedBigInteger('facility_id')->nullable()->index();
	        $table->unsignedBigInteger('user_id')->nullable()->index();
	        $table->unsignedBigInteger('category_id')->nullable()->index();
	        $table->boolean('virtual')->default(0);
	        $table->timestamps();
	        $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
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
        Schema::dropIfExists('schedules');
    }
}
