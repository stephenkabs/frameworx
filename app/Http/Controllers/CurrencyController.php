<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan; // Import Artisan facade
use Illuminate\Support\Facades\File;

class CurrencyController extends Controller
{
    public function showForm()
    {
        // Return the view for the currency form
        return view('currency_form'); // replace 'your-view-name' with your actual view file
    }

    // public function process(Request $request)
    // {
    //     // Validate the request data
    //     $validated = $request->validate([
    //         'amount' => 'required|numeric',
    //         'currency' => 'required|string',
    //     ]);

    //     $amount = $validated['amount'];
    //     $currency = $validated['currency'];

    //     // Format the currency using the helper function
    //     $formattedAmount = formatCurrency($amount, $currency);

    //     // Optionally, store or return the result
    //     return back()->with('success', "Amount: $formattedAmount");
    // }

    public function update(Request $request)

    {
        // Validate the form input
        $request->validate([
            'currency' => 'required|string|max:3',
        ]);

        // Get the selected currency
        $currency = $request->input('currency');

        // Path to the .env file
        $envPath = base_path('.env');

        // Check if .env file exists
        if (File::exists($envPath)) {
            // Replace the APP_CURRENCY value with the new currency
            $envContents = File::get($envPath);
            $newEnvContents = preg_replace("/^APP_CURRENCY=.*/m", "APP_CURRENCY={$currency}", $envContents);

            // Write the updated contents back to the .env file
            File::put($envPath, $newEnvContents);

            // Clear the config cache so the app uses the updated .env values immediately
            Artisan::call('config:clear');

            return back()->with('success', 'Currency updated successfully!');
        }

        return back()->with('error', 'Unable to update currency.');
    }
}


