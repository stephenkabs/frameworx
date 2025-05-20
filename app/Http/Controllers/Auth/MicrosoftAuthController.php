<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftAuthController extends Controller
{
    /**
     * Redirect the user to Microsoft OAuth
     */
    public function redirectToMicrosoft()
    {
        return Socialite::driver('microsoft')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    /**
     * Handle Microsoft OAuth callback
     */
    public function handleMicrosoftCallback()
    {
        try {
            $microsoftUser = Socialite::driver('microsoft')->user();
            Log::info('Microsoft User:', (array) $microsoftUser);

            $user = User::updateOrCreate(
                ['email' => $microsoftUser->getEmail()],
                [
                    'name' => $microsoftUser->getName(),
                    'email' => $microsoftUser->getEmail(),
                    'password' => bcrypt(uniqid()), // Auto-generate password
                ]
            );

            if ($user->wasRecentlyCreated) {
                Log::info('New user created: ' . $user->email);
            } else {
                Log::info('Existing user logged in: ' . $user->email);
            }

            Auth::login($user);
            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            Log::error('Microsoft OAuth Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Login failed: ' . $e->getMessage());
        }
    }


    // public function handleMicrosoftCallback()
    // {
    //     try {
    //         $microsoftUser = Socialite::driver('microsoft')->user();
    //         Log::info('Microsoft User:', (array) $microsoftUser);


    //         $specialCode = 'ZRA-' . strtoupper(Str::random(8)); // Generate a unique special code
    //         $name = $microsoftUser->getName() ?? 'user'; // Default if name is null
    //         $slug = Str::slug($name) . '-' . Str::random(5); // Ensure unique slug format
    //         $user = User::updateOrCreate(
    //             ['email' => $microsoftUser->getEmail()],
    //             [
    //                 'name' => $microsoftUser->getName(),
    //                 'email' => $microsoftUser->getEmail(),
    //                 'password' => bcrypt(uniqid()), // Auto-generate password
    //                 'special_code' => $specialCode, // Assign the generated special code
    //                 'slug' => $slug, // Unique slug
    //             ]
    //         );

    //         if ($user->wasRecentlyCreated) {
    //             Log::info('New user created: ' . $user->email);
    //         } else {
    //             Log::info('Existing user logged in: ' . $user->email);
    //         }

    //         Auth::login($user);
    //         return redirect()->route('dashboard');
    //     } catch (\Exception $e) {
    //         Log::error('Microsoft OAuth Error: ' . $e->getMessage());
    //         return redirect('/login')->with('error', 'Login failed: ' . $e->getMessage());
    //     }
    // }




    // public function handleMicrosoftCallback()
    // {
    //     try {
    //         $microsoftUser = Socialite::driver('microsoft')->user();
    //         Log::info('Microsoft User:', (array) $microsoftUser);

    //         $specialCode = 'ZRA-' . strtoupper(Str::random(8)); // Generate a unique special code
    //         $name = $microsoftUser->getName() ?? 'user'; // Default if name is null
    //         $slug = Str::slug($name) . '-' . Str::random(5); // Ensure unique slug format

    //         $user = User::updateOrCreate(
    //             ['email' => $microsoftUser->getEmail()],
    //             [
    //                 'name' => $name,
    //                 'email' => $microsoftUser->getEmail(),
    //                 'special_code' => $specialCode, // Assign the generated special code
    //                 'slug' => $slug, // Unique slug
    //                 'password' => bcrypt(uniqid()), // Auto-generate password
    //             ]
    //         );

    //             if ($user->wasRecentlyCreated) {
    //             Log::info('New user created: ' . $user->email);
    //         } else {
    //             Log::info('Existing user logged in: ' . $user->email);
    //         }

    //         Auth::login($user);
    //         return redirect()->route('dashboard');
    //     } catch (\Exception $e) {
    //         Log::error('Microsoft OAuth Error: ' . $e->getMessage());
    //         return redirect('/login')->with('error', 'Login failed: ' . $e->getMessage());
    //     }
    // }
}
