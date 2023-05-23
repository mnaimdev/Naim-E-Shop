<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerLoginMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {

        if (!Auth::guard('customerlogin')->check()) {
            return redirect()->route('customer.login');
        }

        return $next($request);
    }
}
