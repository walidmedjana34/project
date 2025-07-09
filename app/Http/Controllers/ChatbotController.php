<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController
{
    public function send(Request $request)
    {
        $message = $request->input('message');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'), // ⚠️ nouvelle variable dans .env
                'Content-Type' => 'application/json',
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'meta-llama/llama-4-scout-17b-16e-instruct',
                'messages' => [
                    ['role' => 'user', 'content' => $message]
                ],
                'temperature' => 0.7,
                'max_tokens' => 300
            ]);

            if ($response->failed()) {
                Log::error('Groq API Error', ['body' => $response->body()]);
                return response()->json(['error' => 'Réponse indisponible.']);
            }

            return response()->json([
                'reply' => $response->json('choices.0.message.content')
            ]);

        } catch (\Exception $e) {
            Log::error('Exception chatbot:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Erreur serveur.'], 500);
        }
    }
}
