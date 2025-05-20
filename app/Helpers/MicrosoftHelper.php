<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class MicrosoftHelper
{
    public static function getAccessToken()
    {
        $response = Http::asForm()->post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
            'client_id'     => env('MICROSOFT_CLIENT_ID'),
            'client_secret' => env('MICROSOFT_CLIENT_SECRET'),
            'scope'         => 'https://graph.microsoft.com/.default',
            'grant_type'    => 'client_credentials',
        ]);

        return $response->json()['access_token'] ?? null;
    }
}
