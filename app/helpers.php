<?php

use Ghanem\Rating\Models\Rating;
use Illuminate\Support\Facades\Auth;

function is_admin(){
	return (Auth::check() && Auth::user()->hasRole('Administrator'));
}

function belongs_to_auth($user_id){
    return (Auth::check() && $user_id === Auth::id());
}

function check_image_permission($image_id){
	$image = \App\Images::findOrFail($image_id);
	if($image->visible_level == 1){
		if (Auth::check()){
			return true;
		} else {
			return false;
		}
	} else {
		return true;
	}
}

function getUserRateImage($image_id){

	$userRate = Rating::where([
		'ratingable_type' => 'App\Images',
		'ratingable_id' => $image_id,
		'author_id' => Auth::id(),
	])->first();

	if($userRate){
		return $userRate;
	} else {
		return false;
	}

}
