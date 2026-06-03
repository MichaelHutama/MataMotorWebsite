<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, \Closure $next) {
        if (auth()->guard('web')->check()) {
            return $next($request);
        }
        return redirect()->route('customer.login.page')->with('error', 'Silakan login sebagai Customer terlebih dahulu.');
    }
}
