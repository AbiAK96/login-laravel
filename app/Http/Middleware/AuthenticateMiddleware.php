<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Check if the user is an admin
            if (Auth::user()->role === 'admin') {
                return $next($request);
            } else {
                return redirect('/');
            }
        }
        return redirect('/login');
    }
}
