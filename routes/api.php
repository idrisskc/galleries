<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

	/* ===================== */
	/* === API images === */
	/* ===================== */

	// All images from single user //
	Route::get('users/{user}/images','UsersController@userImages');
	// Remove single image //
	Route::delete('images/{image}','ImagesController@destroy');
	// Get single image //
	Route::get('images/{id}','ImagesController@show');
	// Update  single image //
	Route::patch('images/{id}','ImagesController@update');

	/* ===================== */
	/* === API comments === */
	/* ===================== */

	// Create new comment to image //
	Route::post('comment','CommentsController@store');
	// Get all comments on image  //
	Route::get('images/{id}/comments','ImagesController@comments');

});

