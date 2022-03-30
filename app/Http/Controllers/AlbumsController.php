<?php

namespace App\Http\Controllers;

use App\Album;
use App\AlbumsImage;
use App\Images;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AlbumsController extends Controller
{

	public function __construct() {
		$this->middleware('album_permission', ['except' => ['show']]);
	}

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $users = User::all();
        return view('albums.create', compact('user', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate fields from albums.edit
	    $request->validate([
		    'name' => 'required|max:55|min:3|max:25',
		    'primary_image' => 'required',
		    'description' => 'required|min:5|max:255',
		    'images.*' => 'mimes:jpeg,bmp,png,gif|max:1500',
		    'primary_image' => 'mimes:jpeg,bmp,png,gif|max:1500'
//		    'images'  => 'required'
	    ],[
		    'required' => 'To pole jest wymagane',
		    'min' => 'Pole musi mieć minimum :min znaków',
		    'max' => 'Pole może mieć maksymalnie :max znaków'
	    ]);

        //images directory to save (single user images catalog)
        $imagesDIR = 'storage/users/' . Auth::id() . '/images/';

	    if($request->file('primary_image')) {

            Storage::makeDirectory('public/users/' . Auth::id() . '/images');

            $primaryImg = $request->primary_image;

            // hashed image name
            $hashImgName = pathinfo($primaryImg->hashName(), PATHINFO_FILENAME).'.'.$primaryImg->getClientOriginalExtension();
            // set created img name (this name set in database)
            $imgName = $hashImgName;

            //make and save image (full size version) by intervention img.
            Image::make($primaryImg)
                ->encode('jpg', 85)
                ->orientate()
                ->fit(320,320)
                ->orientate()
                ->save(public_path($imagesDIR . $imgName));


            // Insert to DB
            $insertAlbum = $this->storePrimaryToDB($imgName, $request);

        }

	    if($request->file('images')) {

		    foreach ( $request->images as $image ) {

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

                //insert image to database
                $insertImage = $this->storeImageToDB( $imgName );

                // make row in pivot table album_image (relation)
				$this->storeAlbumImageToDB($insertAlbum, $insertImage->id);

		    }
	    }

	    if($request->input('check_image')){

		    $checkedImages = $request->input('check_image');

		    //store to databse checked existing images
            foreach ($checkedImages as $checkImage){
			    $this->storeAlbumImageToDB($insertAlbum, $checkImage);
		    }
	    }


	    // Set session flash message this msg will display in albums page after save.
        Session::flash('message', "Dodano nowy album.");
        return redirect()->route('user-albums', ['id' => Auth::id()]);

    }


    // Create new album in databse
    public function storePrimaryToDB($filename, Request $request){
        $album = Album::create([
            'user_id' => Auth::id(),
            'title' => $request->name,
            'alt' => '',
            'description' => $request->description,
            'primary_image' =>  $filename,
            'visible_level' => 0,
            'permission' => 0,
	        'access_users' => json_encode( $request->check_users),
	        'views' => 0
        ]);

        return $album;
    }

    // Create new image in database
	public function storeImageToDB($filename){
		$image = Images::create([
			'user_id' => Auth::id(),
			'path' =>  $filename,
			'visible_level' => 0,
			'permission' => 0,
			'comments' => true,
			'rating' => true,
			'views' => 0
		]);

		return $image;
	}


	// store relation album-image to database
	public function storeAlbumImageToDB($insertAlbum, $insertImg){
		AlbumsImage::create([
			'album_id' => $insertAlbum->id,
			'image_id' => $insertImg,
		]);
	}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, Album $album)
    {
    	$user = User::findOrFail($user);

    	if ($album->access_users != null && Auth::user()->hasRole('User'))
    	{
    		$accessUsers = json_decode($album->access_users);
    		if(!in_array(Auth::id(), $accessUsers)){
    			abort('401');
		    }
	    }

	    $album->update(['views' => $album->views+1]);

        return view('albums.single', compact('album', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Album $album)
    {

    	$users = User::all();

	    return view( 'albums.edit', compact( 'user', 'album', 'users' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user, $id)
    {

    	$album = Album::findOrFail($id);

	    $request->validate([
//		    'name' => 'required|max:55|min:3|max:25',
//		    'primary_image' => 'required',
//		    'description' => 'required|min:5|max:255',
//		    'images'  => 'required'
	    ],[
		    'required' => 'To pole jest wymagane',
		    'min' => 'Pole musi mieć minimum :min znaków',
		    'max' => 'Pole może mieć maksymalnie :max znaków'
	    ]);

	    if($request->primary_image){

		    $primaryImg = $request->primary_image;

		    $image = Image::make($primaryImg)->encode('jpg', 85)->fit(320,320);

		    $thumbnail_image_name = pathinfo($primaryImg->hashName(), PATHINFO_FILENAME).'.'.$primaryImg->getClientOriginalExtension();
		    $image->save(public_path('storage/users/' . Auth::id() . '/images/' . $thumbnail_image_name));

	    }

	    $checkedUsers = null;

	    if($request->check_users) {
		    $checkedUsers = json_encode( $request->check_users );
	    }

	    Album::where(['id' => $id])->update([
		    'title' => $request->name,
		    'description' => $request->description,
//	        'primary_image' =>  $thumbnail_image_name,
	        'access_users'  => $checkedUsers,
	    ]);

	    if($request->remove_image)
	    {
		    foreach ( $request->remove_image as $image ) {
				AlbumsImage::where('album_id', '=', $id)->orWhere('image_id' , '=', $image)->delete();
		    }
	    }

		if($request->check_image) {
			$checkedImages = $request->check_image;

			foreach ( $checkedImages as $checkImage ) {
				AlbumsImage::create( [
					'album_id' => $id,
					'image_id' => $checkImage,
				] );
			}
		}



	    Session::flash('message', "Album zaktualizowany.");
	    return redirect()->route('user-albums', ['id' => Auth::id()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $album_id)
    {
        if(Album::findOrFail($album_id)->delete()){
	        Session::flash('message-remove-album', "Album zostal usunięty.");
        }

	    return redirect('/users/' . $user_id . '/albums');
    }
}
