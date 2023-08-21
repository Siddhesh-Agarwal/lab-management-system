<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string...$guards): Response
    {

        if (Auth::guard()->check() && Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // else if(Auth::guard($guards)->check() && Auth::user()->role == 'superadmin'){
        //     return redirect()->route('admin.dashboard');
        // }
        return $next($request);
    }
}
