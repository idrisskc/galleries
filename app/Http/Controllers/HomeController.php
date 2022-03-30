<?php

namespace App\Http\Controllers;

use App\Album;
use App\Images;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$images = Images::orderBy('created_at', 'desc')->paginate(16);

	    if ($request->ajax()) {
		    $view = view('data',compact('images'))->render();
		    return response()->json(['html'=>$view]);
	    }

        return view('home', compact('images'));
    }
}
