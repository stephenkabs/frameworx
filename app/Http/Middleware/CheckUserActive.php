<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserActive
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->active) {
            return redirect()->route('restricted.contact-admin')->with('message', 'Your account is inactive. Please contact the administrator.');
        }

        return $next($request);
    }
}
