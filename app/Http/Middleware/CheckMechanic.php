<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMechanic
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, \Closure $next) {
        if (auth()->guard('mechanic')->check() && auth()->guard('mechanic')->user()->MechanicID !== 'MEC-0') {
            return $next($request);
        }
        return redirect()->route('admin.login.page')->with('error', 'Akses ditolak. Halaman khusus Mekanik.');
    }
}
