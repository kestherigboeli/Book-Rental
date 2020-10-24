<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('activities', function (Blueprint $table) {
		    $table->bigIncrements('id');
		    $table->string('type');
		    $table->longText('description')->nullable();
		    $table->morphs('activity');
		    $table->unsignedBigInteger('studio_id')->nullable()->index();
		    $table->unsignedBigInteger('user_id')->nullable()->index();
		    $table->timestamps();
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
        Schema::dropIfExists('activities');
    }
}
