<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [ 'user_id', 'image_id', 'album_id', 'type', 'body'];
}
