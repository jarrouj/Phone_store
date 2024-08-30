<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{

    // If the user is not logged in
    if (!Auth::check()) {
        // Allow access to login and register routes
        if (in_array($request->route()->getName(), ['login', 'register'])) {
            return $next($request);
        }
        // Redirect unauthenticated users from protected routes
        return redirect('/login');
    }

    // dd($request->is('admin'));
    // If the user is logged in but has a usertype of 0 and tries to access the /admin route
    if (Auth::user()->usertype == 0 && $request->is('admin')) {
        return redirect('/');
    }

    // If the user is logged in and tries to access login or register routes
    if (in_array($request->route()->getName(), ['login', 'register'])) {
        return redirect('/');
    }

    return $next($request);
}

}
