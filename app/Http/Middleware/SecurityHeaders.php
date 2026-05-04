<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Menambahkan Security Headers untuk melindungi aplikasi dari serangan umum.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Mencegah website dibuka di dalam iframe (Clickjacking)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // Mencegah browser menebak tipe konten (MIME Sniffing)
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Perlindungan dasar XSS untuk browser lama
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Membatasi informasi referrer yang dikirim
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Content Security Policy (CSP)
        if (app()->environment('local')) {
            // Di lingkungan lokal, kita buat sangat fleksibel agar tidak memblokir Vite, Alpine, atau Browser DevTools
            $csp = "default-src 'self' 'unsafe-inline' 'unsafe-eval' data: *; "
                 . "script-src 'self' 'unsafe-inline' 'unsafe-eval' *; "
                 . "style-src 'self' 'unsafe-inline' *; "
                 . "font-src 'self' data: *; "
                 . "img-src 'self' data: https: http: *; "
                 . "connect-src 'self' ws: wss: *;";
        } else {
            // Kebijakan ketat untuk Produksi (cPanel)
            $csp = "default-src 'self'; "
                 . "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://unpkg.com https://code.jquery.com; "
                 . "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net; "
                 . "font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net; "
                 . "img-src 'self' data: https:; "
                 . "connect-src 'self' https://cdn.jsdelivr.net;";
        }

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
