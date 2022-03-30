<?php

namespace App\Http\Controllers\Api\V1;

use App\Comment;
use App\Images;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return Images::all();
    }

	public function show($id)
	{
		return Images::findOrFail($id);
	}

    public function comments($id)
    {
        $image = Images::findOrFail($id);
        $comments = $image->comments()->get();

        $completeArray = array();

        foreach ($comments as $comment){
        	$user = User::findOrFail($comment->user_id);
	        $newArr = array('user_name' => $user->name);
	        $arr = array_merge($comment->toArray(), $newArr);
	        array_push($completeArray, $arr);
        }

	    return response()->json($completeArray);
    }

    public function update(Request $request, $id)
    {
        $image = Images::findOrFail($id);
        $image->update($request->all());

        return $image;
    }

    public function store(Request $request)
    {
        $image = Images::create($request->all());
        return $image;
    }

    public function destroy($id)
    {
        $image = Images::findOrFail($id);
        $image->delete();
        return '';
    }
}
