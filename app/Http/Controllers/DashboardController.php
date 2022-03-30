<?php

namespace App\Http\Controllers;

use App\Album;
use App\Comment;
use App\Images;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

	public function __construct() {
		$this->middleware('isAdmin');
	}

	public function index(){

		$imagesCount = Images::all()->count();
		$albumsCount = Album::all()->count();
		$usersCount = User::all()->count();
		$commentsCount = Comment::all()->count();

    	return view('admin.dashboard', compact('imagesCount', 'albumsCount', 'usersCount', 'commentsCount'));
    }
}
