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
        if (Auth::guard($guard)->check()) {
            $auth = Auth::user()->type;
        switch($auth){
            case "A":
                return redirect('/admin');
                break;
            case "D":
                return redirect('/dosen');
                break;
            case "M":
                return redirect('/mahasiswa');
                break;
        }
        }

        return $next($request);
    }
}
