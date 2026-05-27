<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectByRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            // ROLE ADMIN
            if (Auth::user()->role === 'admin') {
                return redirect('/dashboard');
            }

            // ROLE USER
            if (Auth::user()->role === 'user') {
                return redirect('/user/dashboard');
            }

            return redirect('/');
        }

        return $next($request);
    }
}