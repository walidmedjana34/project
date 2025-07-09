<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class AIController
{
    public function generateDescription(Request $request)
    {
        try {
            $prompt = $request->prompt;

            $agency = auth('agency')->user();
            if (!$agency) {
                return response()->json([
                    'redirect' => route('login'),
                    'error' => 'Veuillez vous connecter.'
                ], 401);
            }

            // Gestion des limites selon le type de compte
            $limit = $agency->is_premium ? null : ($agency->is_pro ? 5 : 1);

            $cacheKey = 'desc_gen_' . $agency->id . '_' . now()->toDateString();
            $currentCount = Cache::get($cacheKey, 0);

            if ($limit !== null && $currentCount >= $limit) {
                return response()->json([
                    'redirect' => route('service.services'),
                    'error' => 'Vous avez atteint la limite quotidienne de génération. Veuillez souscrire à un plan.'
                ], 429);
            }

            $apiKey = env('GROQ_API_KEY');
            if (empty($apiKey)) {
                throw new \Exception('Configuration error: API key missing');
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'meta-llama/llama-4-scout-17b-16e-instruct',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt]
                ],
                'temperature' => 0.7,
                'max_tokens' => 300
            ]);

            if (!$response->successful()) {
                Log::error('Groq API Error (description)', ['response' => $response->body()]);
                return response()->json([
                    'error' => 'Erreur du service AI. Veuillez réessayer plus tard.'
                ], 500);
            }

            // Mise à jour du compteur d'utilisation
            if ($limit !== null) {
                Cache::put($cacheKey, $currentCount + 1, now()->endOfDay());
            }

            $text = $response->json('choices.0.message.content');

            return response()->json([
                'description' => $text,
                'remaining' => $limit !== null ? $limit - ($currentCount + 1) : 'unlimited'
            ]);

        } catch (\Exception $e) {
            Log::error('AIController Error', ['message' => $e->getMessage()]);
            return response()->json([
                'error' => 'Une erreur inattendue est survenue. Veuillez contacter le support.'
            ], 500);
        }
    }
}
