<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeAlbumsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::create('albums_images', function (Blueprint $table) {

		    $table->increments('id');
		    $table->integer('album_id')->unsigned();
		    $table->integer('image_id')->unsigned();

//		    $table->foreign('album_id')->references('id')->on('albums');
//		    $table->foreign('image_id')->references('id')->on('images');

	    });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('albums_images');
	}
}
