<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmailController extends Controller
{
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'mail_driver' => 'required|string',
            'mail_host' => 'required|string',
            'mail_port' => 'required|integer',
            'mail_username' => 'required|string',
            'mail_password' => 'required|string',
            'mail_encryption' => 'required|string',
            'mail_from_address' => 'required|email',
            'mail_from_name' => 'required|string',
        ]);

        // Get the path to the .env file
        $envPath = base_path('.env');

        // Check if the .env file exists
        if (!File::exists($envPath)) {
            return redirect()->back()->withErrors('The .env file does not exist.');
        }

        // Get the current .env content
        $envContent = File::get($envPath);

        // Update or add email settings
        $envContentUpdated = false;

        // Update or add mail configurations
        $configKeys = [
            'MAIL_DRIVER' => $request->mail_driver,
            'MAIL_HOST' => $request->mail_host,
            'MAIL_PORT' => $request->mail_port,
            'MAIL_USERNAME' => $request->mail_username,
            'MAIL_PASSWORD' => $request->mail_password,
            'MAIL_ENCRYPTION' => $request->mail_encryption,
            'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            'MAIL_FROM_NAME' => $request->mail_from_name,
        ];

        foreach ($configKeys as $key => $value) {
            if (preg_match("/^$key=(.*)$/m", $envContent)) {
                $envContent = preg_replace("/^$key=(.*)$/m", "$key=$value", $envContent);
                $envContentUpdated = true;
            } else {
                $envContent .= "\n$key=$value";
                $envContentUpdated = true;
            }
        }

        // Write the updated content back to the .env file if there were changes
        if ($envContentUpdated) {
            File::put($envPath, $envContent);
        }

        return redirect()->back()->with('success', 'Email configuration updated successfully.');
    }
}
