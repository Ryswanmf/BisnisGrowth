<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function generateArticle($topic)
    {
        if (!$this->apiKey) {
            return ['error' => 'API Key Gemini belum diatur di .env'];
        }

        // Urutan model dari yang paling cerdas ke yang paling stabil
        $models = [
            ['name' => 'gemini-1.5-flash', 'api' => 'v1beta'],
            ['name' => 'gemini-1.5-flash-latest', 'api' => 'v1beta'],
            ['name' => 'gemini-pro', 'api' => 'v1'],
        ];

        $prompt = "Anda adalah penulis artikel bisnis profesional. Buat artikel lengkap (600-800 kata) tentang topik: \"$topic\".
        WAJIB berikan hasil dalam format JSON VALID:
        {
            \"title\": \"Judul\",
            \"content\": \"Isi HTML (h2, p, strong)\",
            \"excerpt\": \"Ringkasan\",
            \"meta_title\": \"Meta Title\",
            \"meta_description\": \"Meta Description\",
            \"focus_keyword\": \"Keyword\"
        }";

        foreach ($models as $m) {
            try {
                $url = "https://generativelanguage.googleapis.com/{$m['api']}/models/{$m['name']}:generateContent?key={$this->apiKey}";
                
                $payload = [
                    'contents' => [['parts' => [['text' => $prompt]]]]
                ];

                // JSON Mode hanya didukung di v1beta
                if ($m['api'] === 'v1beta') {
                    $payload['generationConfig'] = ['response_mime_type' => 'application/json'];
                }

                $response = Http::withoutVerifying()->timeout(60)->post($url, $payload);

                if ($response->successful()) {
                    $data = $response->json();
                    $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if ($text) {
                        $jsonString = preg_replace('/^```json\s*|```$/', '', trim($text));
                        $decoded = json_decode($jsonString, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            return $decoded;
                        }
                    }
                }

                // Jika error karena beban tinggi (503), lanjut ke model berikutnya
                Log::warning("Gemini Model {$m['name']} sibuk atau gagal: " . $response->status());
                
            } catch (\Exception $e) {
                Log::error("Gemini Exception pada {$m['name']}: " . $e->getMessage());
            }
        }

        return ['error' => 'Layanan AI sedang sibuk karena permintaan yang sangat tinggi di server Google. Silakan coba lagi dalam 1-2 menit.'];
    }
}
