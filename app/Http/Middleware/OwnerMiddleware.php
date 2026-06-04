<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
public function handle(Request $request, Closure $next): Response
{
    if (session('role') !== 'owner') {
        return redirect()->route('loginadminmechanic')->with('error', 'Akses ditolak.');
    }
    return $next($request);
}
}
