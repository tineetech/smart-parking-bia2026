<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {

        if (!Auth::check()) {
            if ($role === 'admin') {
                return redirect('/login');
            } else if ($role === 'user') {
                return redirect('/user/login');
            }
        }

        if (Auth::user()->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}