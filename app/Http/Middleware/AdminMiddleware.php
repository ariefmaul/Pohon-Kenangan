<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user login dan role = admin
        if (Auth::check() && Auth::user() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin, tampilkan error 403
        abort(403, 'Unauthorized');
    }
}
