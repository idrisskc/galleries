<?php

namespace App\Http\Controllers\Api\V1;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{

	public function __construct()
	{
//        $this->middleware('auth');
	}

    public function store(Request $request)
    {
//    	var_dump($request);
//    	exit;
        $company = Comment::create($request->all());
        return $company;
    }

    public function destroy($id)
    {
        $company = Comment::findOrFail($id);
        $company->delete();
        return '';
    }

}
