<?php

namespace App\Http\Controllers;

use App\Models\PricingPlan;
use App\Models\User;
use App\Models\PlanFeature;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view pricing',['only'=> ['index','show']]);
    //    $this->middleware('permission:create pricing',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit pricing',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete pricing',['only'=> ['destroy']]);

    // }
    public function index()
    {
        $plans = PricingPlan::with('features')->get();
        return view('pricingPlan.index', compact('plans'));
    }

    public function create()
    {
        return view('pricingPlan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'price' => 'required|numeric',
            'button_name' => 'required|string|max:255',
            'button_link' => 'required|string|max:255',
            'billing_cycle' => 'required|string',
            'features' => 'required|array',
            'features.*' => 'required|string',
        ]);

        $plan = PricingPlan::create([
            'button_name' => $validated['button_name'],
            'button_link' => $validated['button_link'],
            'currency' => $validated['currency'],
            'name' => $validated['name'],
            'price' => $validated['price'],
            'billing_cycle' => $validated['billing_cycle']
        ]);

        foreach ($validated['features'] as $feature) {
            $plan->features()->create(['feature' => $feature]);
        }

        return redirect()->route('pricingPlan.index')->with('success', 'Pricing plan created successfully.');
    }

    public function show(PricingPlan $pricingPlan)
    {
        return view('pricing.show', compact('pricingPlan'));
    }

    public function edit(PricingPlan $pricingPlan)
    {
        return view('pricingPlan.edit', compact('pricingPlan'));
    }

    public function update(Request $request, PricingPlan $pricingPlan)
{
    // Validate the request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'currency' => 'required|string|max:255',
        'button_name' => 'required|string|max:255',
        'button_link' => 'required|string|max:255',
        'price' => 'required|numeric',
        'billing_cycle' => 'required|string',
        'features' => 'required|array',
        'features.*' => 'required|string',
    ]);

    // Update the pricing plan
    $pricingPlan->update([
        'name' => $validated['name'],
        'currency' => $validated['currency'],
        'button_name' => $validated['button_name'],
        'button_link' => $validated['button_link'],
        'price' => $validated['price'],
        'billing_cycle' => $validated['billing_cycle'],
    ]);

          // Update the user with the selected pricing plan
        //   $user = User::findOrFail($validated['user_id']);
        //   $user->pricing_plan_id = $validated['pricing_id'];
        //   $user->save();

    // Update the features
    $pricingPlan->features()->delete(); // Delete old features
    foreach ($validated['features'] as $feature) {
        $pricingPlan->features()->create(['feature' => $feature]);
    }

    // Redirect to the pricing.index page
    return redirect()->route('pricingPlan.index')->with('success', 'Pricing plan updated successfully.');
}

    public function destroy(PricingPlan $pricingPlan)
    {
        $pricingPlan->features()->delete(); // Delete associated features first
        $pricingPlan->delete();

        return redirect()->route('pricingPlan.index')->with('success', 'Pricing plan deleted successfully.');
    }
}
