<?php

namespace App\Http\Controllers;

use App\Images;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ImagesController extends Controller
{

	public function __construct() {
		$this->middleware('auth', ['except' => ['show', 'prevImage', 'nextImage']]);
		$this->middleware('images_permission', ['except' => ['show', 'prevImage', 'nextImage', 'rate', 'store']]);
	}

    public function create(User $user)
    {
        return view('images.create', compact('user'));
    }

    public function store(Request $request, $id)
    {

	    // Validate images from form
	    $request->validate([
		    'images.*' => 'mimes:jpeg,bmp,png,gif|max:1500'
	    ],[
		    'max' => 'The maximum size of the photo is: max kb. One of the photos you selected exceeds this size.'
	    ]);

    	//Set images variable
    	$images = $request->images;

    	// Create single user images directory if is not exist (image intervention Image class no create automatic dir)
        Storage::makeDirectory('public/users/' . Auth::id() . '/images');

        // If post has images array start foreach
	    if($request->file('images')) {

	    	//Loop on all images from POST form
		    foreach ($images as $image) {

		    	//images directory to save (single user images catalog)
		    	$imagesDIR = 'storage/users/' . Auth::id() . '/images/';
		    	// hashed image name
		    	$hashImgName = pathinfo($image->hashName(), PATHINFO_FILENAME).'.'.$image->getClientOriginalExtension();

		    	// set created img name (this name set in database)
			    $imgName = $hashImgName;

			    //make and save image (full size version) by intervention img.
                Image::make($image)
                     ->encode('jpg', 85)
                     ->orientate()
                     ->fit(1600,1400)
                     ->orientate()
	                 ->save(public_path($imagesDIR . $imgName));

			    // set created thumbnail name
                $thumbName = 'thumb-' . $hashImgName;
			    //make and save image (thumb version) by intervention img.
			    Image::make($image)
			         ->encode('jpg', 85)
			         ->orientate()
			         ->fit(360,360)
			         ->save(public_path($imagesDIR . $thumbName));

			    // create image record in database
                $this->storeToDB($imgName);

		    }

		    // If all okay set message by session
		    Session::flash('message', "You have successfully added your photos.");

	    } else {

		    // If something went wrong send message with bad content
		    Session::flash('message', "An error occurred while adding photos");

	    }
        return redirect()->route('user-images', ['id' => Auth::id()]);
    }

    //Save single image to database
    private function storeToDB($filename){
        Images::create([
            'user_id' => Auth::id(),
            'path' =>  $filename,
            'visible_level' => 0,
            'permission' => 0,
            'comments' => true,
            'rating' => true,
	        'views' => 0
        ]);
    }

	public function nextImage(User $user, $image_id)
	{
		if(!$image = Images::where('id', '>', $image_id)->where('user_id', '=',  $user->id)->first()){
			$image = Images::where('user_id', '=',  $user->id)->first();
		}

		$this->incrementStatistics($image);

		return view('images.single', compact('image', 'user'));
	}


	public function prevImage(User $user, $image_id)
	{
		if(!$image = Images::where('id', '<', $image_id)->where('user_id', '=',  $user->id )->orderBy('id', 'desc')->first()){
			$image = Images::where('user_id', '=',  $user->id )->orderBy('id', 'desc')->first();
		}

		$this->incrementStatistics($image);

		return view('images.single', compact('image', 'user'));
	}


    public function show(User $user, Images $image)
    {
	    $this->incrementStatistics($image);
        return view('images.single', compact('image', 'user'));
    }

//    public function edit($id)
//    {
//        //
//    }
//
//    public function update(Request $request, $id)
//    {
//        //
//    }

    public function destroy($user_id, Images $image)
    {
	    try {
		    $image->delete();
	    } catch ( \Exception $e ) {
	    }

	    return back();
    }

    public function rate(Images $image)
    {
    	$value = Input::get('rate_value');

	    $image->rating([
		    'rating' => $value
	    ], Auth::user());

		return back();
    }

    private function incrementStatistics(Images $image)
    {
	    $image->update(['views' => $image->views+1]);
    }

}
