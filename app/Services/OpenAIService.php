<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService
{
    protected $apiKey;
    protected $apiUrl = 'https://api.openai.com/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openai.key');
    }

    public function generateArticle($topic)
    {
        if (!$this->apiKey) {
            Log::error('OpenAI Error: API Key is not configured.');
            return null;
        }

        $prompt = "Anda adalah penulis artikel bisnis profesional untuk platform BisnisGrowth. 
        Tugas Anda adalah membuat artikel lengkap berdasarkan topik atau kata kunci: \"$topic\".
        
        Persyaratan Konten:
        1. Bahasa: Indonesia yang profesional namun mudah dipahami UMKM.
        2. Panjang Konten: Minimal 600-800 kata.
        3. Format Konten: Gunakan tag HTML (<h2> untuk sub-judul, <p> untuk paragraf, <strong> untuk penekanan).
        4. Struktur: Sertakan pendahuluan yang menarik dengan gaya Drop Cap.
        
        Berikan output dalam format JSON dengan struktur berikut:
        {
            \"title\": \"Judul SEO yang menarik\",
            \"content\": \"Isi konten lengkap dalam format HTML\",
            \"excerpt\": \"Ringkasan artikel sekitar 150-200 karakter\",
            \"meta_title\": \"Judul untuk meta tag SEO\",
            \"meta_description\": \"Deskripsi untuk meta tag SEO\",
            \"focus_keyword\": \"Kata kunci utama artikel\"
        }";

        try {
            $response = Http::withToken($this->apiKey)
                ->withoutVerifying()
                ->post($this->apiUrl, [
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => 'Anda adalah asisten ahli penulis konten bisnis yang mengembalikan hasil hanya dalam format JSON valid.'
                        ],
                        [
                            'role' => 'user',
                            'content' => $prompt
                        ]
                    ],
                    'response_format' => ['type' => 'json_object'],
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $contentString = $data['choices'][0]['message']['content'] ?? null;

                if ($contentString) {
                    return json_decode($contentString, true);
                }
            } else {
                $errorData = $response->json();
                $errorMessage = $errorData['error']['message'] ?? 'Unknown OpenAI Error';
                Log::error('OpenAI Request Failed: ' . $errorMessage);
                return ['error' => $errorMessage];
            }
        } catch (\Exception $e) {
            Log::error('OpenAI Exception: ' . $e->getMessage());
            return ['error' => $e->getMessage()];
        }

        return null;
    }
}
