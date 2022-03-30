<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('alt')->nullable();
            $table->string('description')->nullable();
            $table->string('path');
            $table->boolean('comments')->nullable();
	        $table->boolean('rating')->nullable();
            $table->integer('visible_level');
	        $table->integer('permission');
	        $table->string('access_users')->nullable();
	        $table->integer('views')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
