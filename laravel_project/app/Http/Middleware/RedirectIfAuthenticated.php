<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
	{
/*
		$redir = '/home';

		switch ($guard) {
		case 'admin':
			$redir = '/admin/home';
			break;
		default:
			$redir = '/home';
			break;
		}

		if (Auth::guard($guard)->check()) {
			return redirect($redir);
		}
		return $next($request);
 */

		switch ($guard) {
			case 'admin':
				if (Auth::guard($guard)->check()) {
					return redirect()->route('admin.item.index');
				}
				break;
			default:
				if (Auth::guard($guard)->check()) {
					return redirect('/home');
				}
				break;
		}
		return $next($request);
	}
}
