<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TrackLastActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user(); // Get the authenticated user
            $user->last_activity = now(); // Update the property
            $user->save(); // Save changes to the database




        }

        return $next($request);
    }



}
