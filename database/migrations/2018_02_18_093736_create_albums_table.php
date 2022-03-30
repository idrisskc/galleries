<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->increments('id');
	        $table->integer('user_id');
	        $table->string('title')->nullable;
	        $table->string('alt')->nullable;
	        $table->string('description')->nullable;
	        $table->string('visible_level');
	        $table->string('permission');
	        $table->string('primary_image');
	        $table->string('access_users')->nullable();
	        $table->bigInteger('views')->unsigned()->nullable();
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
        Schema::dropIfExists('albums');
    }
}
