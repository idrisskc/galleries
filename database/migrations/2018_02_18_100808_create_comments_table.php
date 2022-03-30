<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('image_id')->unsigned()->nullable();
            $table->integer('album_id')->unsigned()->nullable();
            $table->string('type'); //image or album
            $table->string('body');
            $table->timestamps();

//	        $table->foreign('user_id')->references('id')->on('users');
//	        $table->foreign('image_id')->references('id')->on('images');
//	        $table->foreign('album_id')->references('id')->on('albums');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
