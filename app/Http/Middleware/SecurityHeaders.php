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
        
        // Content Security Policy (Dasar - bisa disesuaikan jika butuh load script luar)
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:;");

        return $response;
    }
}
