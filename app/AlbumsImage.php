<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumsImage extends Model
{
	public $timestamps = false;

	protected $fillable = [ 'album_id', 'image_id' ];

}
