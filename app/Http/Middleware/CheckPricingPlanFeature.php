<?php


namespace App\Http\Middleware;
use App\Models\Background;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPricingPlanFeature
{



    public function handle($request, Closure $next, $requiredFeature)
    {
        $user = Auth::user();
        $background = Background::all(); // Fetch the background data

        // Ensure the user is authenticated and has a pricing plan
        if (!$user || !$user->pricingPlan) {
            return response()->view('windows.no_pricing_plan', compact('background'), 403);
        }

        // Check if the user's pricing plan includes the required feature
        $features = $user->pricingPlan->features->pluck('feature')->toArray();
        if (!in_array($requiredFeature, $features)) {
            return response()->view('windows.feature_restricted', compact('requiredFeature', 'background'), 403);
        }

        return $next($request);
    }

}

