<?php

namespace App;

use Ghanem\Rating\Traits\Ratingable as Rating;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed views
 */
class Images extends Model
{

	use Rating;

   protected $fillable = [ 'user_id', 'alt', 'title', 'description', 'path', 'visible_level', 'permission' , 'comments', 'rating', 'views'];

   public function user(){
	   return $this->hasOne('App\User', 'id', 'user_id');
   }

   public function albums(){
	   return $this->belongsToMany('App\Album', 'albums_images',
		   'image_id', 'album_id');
   }

    public function comments(){
        return $this->hasMany('App\Comment', 'image_id', 'id');
    }


}
