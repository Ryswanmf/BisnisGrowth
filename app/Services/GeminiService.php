<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $apiKey;
    // Menggunakan model Gemini 2.5 Flash terbaru di tahun 2026
    protected $apiUrl = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key');
    }

    public function generateArticle($topic)
    {
        if (!$this->apiKey) {
            return ['error' => 'API Key Gemini belum diatur di .env'];
        }

        $prompt = "Anda adalah penulis artikel bisnis profesional untuk platform BisnisGrowth. 
        Tugas: Buat artikel lengkap tentang topik: \"$topic\".
        
        Persyaratan:
        1. Bahasa: Indonesia.
        2. Panjang: Minimal 600-800 kata.
        3. Format: Gunakan HTML (h2, p, strong).
        
        WAJIB berikan hasil HANYA dalam format JSON VALID tanpa teks tambahan apapun.
        Struktur JSON:
        {
            \"title\": \"Judul SEO\",
            \"content\": \"Isi HTML\",
            \"excerpt\": \"Ringkasan artikel\",
            \"meta_title\": \"Meta Title\",
            \"meta_description\": \"Meta Description\",
            \"focus_keyword\": \"Kata Kunci\"
        }";

        try {
            $response = Http::withoutVerifying()->post($this->apiUrl . '?key=' . $this->apiKey, [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'response_mime_type' => 'application/json',
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                
                if ($text) {
                    $decoded = json_decode($text, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        return $decoded;
                    }
                }
                return ['error' => 'Gagal memproses data JSON dari AI.'];
            } else {
                // Jika 2.5 gagal (misal belum aktif di region), coba fallback ke 2.0 atau 1.5
                if ($response->status() == 404) {
                    return $this->tryAlternativeModels($topic);
                }

                $err = $response->json();
                return ['error' => 'Gemini AI: ' . ($err['error']['message'] ?? 'Respon tidak ditemukan')];
            }
        } catch (\Exception $e) {
            return ['error' => 'Kesalahan koneksi ke Google AI.'];
        }
    }

    private function tryAlternativeModels($topic)
    {
        // Mencoba model-model sebelumnya jika 2.5 belum tersedia
        $models = ['gemini-2.0-flash', 'gemini-1.5-flash'];
        
        foreach ($models as $model) {
            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$this->apiKey}";
            
            try {
                $response = Http::withoutVerifying()->post($url, [
                    'contents' => [['parts' => [['text' => "Buat artikel bisnis dalam Bahasa Indonesia tentang $topic. Kembalikan HANYA JSON VALID."]]]],
                    'generationConfig' => ['response_mime_type' => 'application/json']
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    $text = $data['candidates'][0]['content']['parts'][0]['text'] ?? null;
                    if ($text) return json_decode($text, true);
                }
            } catch (\Exception $e) { continue; }
        }

        return ['error' => 'Model Gemini 2.5/2.0/1.5 tidak ditemukan. Mohon pastikan API Key Anda memiliki akses ke model terbaru di Google AI Studio.'];
    }
}
