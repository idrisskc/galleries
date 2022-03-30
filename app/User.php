<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property mixed id
 */

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function images(){
	    return $this->hasMany('App\Images', 'user_id', 'id')->orderBy('created_at', 'desc');
    }

	public function imagesWithPaginate(){
		return $this->hasMany('App\Images', 'user_id', 'id')->orderBy('created_at', 'desc');
	}

    public function albums(){
        return $this->hasMany('App\Album', 'user_id', 'id')->orderBy('created_at', 'desc');
    }

    public function lastImages(){
        return $this->hasMany('App\Images', 'user_id', 'id')->orderBy('created_at', 'desc')->limit(8);
    }

    public function lastAlbums(){
        return $this->hasMany('App\Album', 'user_id', 'id')->orderBy('created_at', 'desc')->limit(4);
    }



}
