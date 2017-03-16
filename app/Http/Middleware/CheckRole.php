<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string 	$role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
		$user = Auth::user();

		if ($user->type != $role) {
			return redirect()->to('login');
		}

        return $next($request);
    }
}
