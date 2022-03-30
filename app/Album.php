<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [ 'user_id', 'title', 'alt', 'description', 'primary_image', 'visible_level', 'permission', 'views' ];

	public function images(){
		return $this->belongsToMany('App\Images', 'albums_images',
			'album_id', 'image_id');
	}
}
