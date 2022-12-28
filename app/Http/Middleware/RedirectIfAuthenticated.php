<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if ($guard == "admin" && Auth::guard($guard)->check()) {
            return redirect('/admin/dashboard');
        }
        if ($guard == "interviewer" && Auth::guard($guard)->check()) {
            return redirect('/interviewer/dashboard');
        }

        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }
        return $next($request);
    }
}
