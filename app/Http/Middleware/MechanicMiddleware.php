<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MechanicMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
public function handle(Request $request, Closure $next): Response
{
    if (session('role') !== 'mechanic') {
        return redirect()->route('loginadminmechanic')->with('error', 'Akses ditolak.');
    }
    return $next($request);
}
}
