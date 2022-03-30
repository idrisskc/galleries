<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Spatie\Permission\Models\Role;

class AdminMiddleware
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

		if (!Auth::check() || !Auth::user()->hasRole('Administrator')) //If user does //not have this permission
		{
			abort('401');
		}

		return $next($request);
	}
}