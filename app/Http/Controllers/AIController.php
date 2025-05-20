<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{

    public function showForm()
{
    return view('ask'); // This loads resources/views/ask.blade.php
}
    public function ask(Request $request)
    {
        $question = $request->input('question');

        $response = Http::withToken('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')
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $question],
                ],
            ]);

        if ($response->successful()) {
            return response()->json([
                'answer' => $response->json()['choices'][0]['message']['content']
            ]);
        } else {
            return response()->json([
                'error' => 'OpenAI error',
                'details' => $response->body()
            ], 500);
        }
    }
}
