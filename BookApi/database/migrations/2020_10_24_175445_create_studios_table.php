<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios', function (Blueprint $table) {
	        $table->unsignedBigInteger('studio_id')->nullable()->index();
	        $table->foreign('studio_id')->references('id')->on('studios')->onDelete('cascade');
	        $table->unsignedBigInteger('user_id')->nullable()->index();
	        $table->boolean('current')->default(true);
	        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
	        $table->timestamps();
	        $table->primary(['studio_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studios');
    }
}
