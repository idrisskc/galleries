<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Intervention\Image\Facades\Image;

/* ===================== */
/* === Home page routes === */
/* ===================== */
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

/* ===================== */
/* === Users routes === */
/* ===================== */
Auth::routes();
Route::resource('users','UsersController');

/* ===================== */
/* === Admin routes === */
/* ===================== */

/* Get admin dashboard */
Route::get('admin','DashboardController@index')->name('dashboard');
/* Get admin user resource  */
Route::resource('admin/users', 'UsersBackendController');
/* Get admin user images page  */
Route::get('admin/users/{user}/images', 'UsersBackendController@images');
/* Get admin roles resource  */
Route::resource('admin/roles', 'RolesController');
/* Get admin permissions resource  */
Route::resource('admin/permissions', 'PermissionsController');

/* ===================== */
/* === Images routes === */
/* ===================== */

Route::resource('images','ImagesController');
/* Get all user images */
Route::get('users/{user}/images','UsersController@userImages')->name('user-images');
/* Get upload images form */
Route::get('users/{user}/images/upload','ImagesController@create');
/* Save upload images by user to database */
Route::post('users/{user}/images/upload','ImagesController@store');
/* Show single user image */
Route::get('users/{user}/images/{image}/','ImagesController@show')->where('image', '[0-9]+');
/* Destroy single image of user */
Route::delete('users/{user}/images/{image}/','ImagesController@destroy')->where('album', '[0-9]+');
/* Show next image of a given user */
Route::get('users/{user}/images/{image}/next','ImagesController@nextImage')->where('image', '[0-9]+');
/* Show previous image of a given user */
Route::get('users/{user}/images/{image}/prev','ImagesController@prevImage')->where('image', '[0-9]+');
/* Rate single image */
Route::post('images/{image}/rate','ImagesController@rate')->name('rate');


/* ===================== */
/* === Albums routes === */
/* ===================== */

/* Get all user albums */
Route::get('users/{user}/albums','UsersController@userAlbums')->name('user-albums');
/* Show next album of a given user */
Route::get('users/{user}/album/{album}images/{image}/next','ImagesController@nextAlbumImage')->where('image', '[0-9]+');
/* Show previous album of a given user */
Route::get('users/{user}/album/{album}images/{image}/prev','ImagesController@prevAlbumImage')->where('image', '[0-9]+');
/* Show single album of user */
Route::get('users/{user}/albums/{album}/','AlbumsController@show')->where('album', '[0-9]+');
/* Destroy single album of user */
Route::delete('users/{user}/albums/{album}/','AlbumsController@destroy')->where('album', '[0-9]+');
/* Get create album form */
Route::get('users/{user}/albums/create','AlbumsController@create');
/* Save create album form to database */
Route::post('users/{user}/albums/create','AlbumsController@store');
/* Edit single album of user */
Route::get('users/{user}/albums/{album}/edit','AlbumsController@edit')->where('album', '[0-9]+');
/* Update single album of user */
Route::patch('users/{user}/albums/{album}','AlbumsController@update')->where('album', '[0-9]+');

/* ===================== */
/* === Comments routes === */
/* ===================== */
Route::post('comment-image/{image}','CommentsController@store');
Route::get('all-comments','CommentsController@index');
Route::delete('all-comments/{comment}','CommentsController@destroy');



