<?php

namespace App\Http\Middleware;

use App\Images;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckImagesPermission {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {

		$image_exists = Images::where( [
			'id'      => $request->image,
			'user_id' => Auth::id(),
		] )->exists();


		if ( ! Auth::check() || ! $image_exists && ! is_admin()  && $request->user->id != Auth::id() ) {
			abort( 401, 'Brak dostępu' );
		}

		return $next( $request );
	}
}
