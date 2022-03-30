<?php

namespace App\Http\Controllers\Api\V1;

use App\Images;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
	public function userImages($id){
        $images = User::findOrFail($id)->images;
        return $images;
    }

	public function userAlbums($id){
		$albums = User::findOrFail($id)->albums;
		return $albums;
	}

}
