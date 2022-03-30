<?php

namespace App\Http\Middleware;

use App\Album;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAlbumPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
	public function handle($request, Closure $next)
	{
		$album_exists = Album::where([
			'id' => $request->album,
			'user_id' => Auth::id(),
		])->exists();

//		if ( ! Auth::check() || ! $album_exists && !is_admin() && $request->user->id != Auth::id() ) {
//			abort(401, 'Brak dostępu');
//		}

		return $next($request);
	}
}
