<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Tenant;

class TenantSubdomain
{
    public function handle(Request $request, Closure $next)
    {
        // Extract subdomain
        $subdomain = $request->route('tenant');

        // Find tenant based on subdomain
        $tenant = Tenant::whereHas('domains', function ($query) use ($subdomain) {
            $query->where('domain', "{$subdomain}.yourapp.com");
        })->first();

        if (!$tenant) {
            abort(404, 'Tenant not found');
        }

        // Set the tenant in the app context (optional)
        app()->instance('tenant', $tenant);

        return $next($request);
    }
}
