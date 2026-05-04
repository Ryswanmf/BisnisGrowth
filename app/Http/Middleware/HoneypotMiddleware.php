<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HoneypotMiddleware
{
    /**
     * Mencegah Bot Spam dengan teknik Honeypot (input tersembunyi).
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 'my_full_name' adalah field jebakan yang harus kosong (disembunyikan dengan CSS)
        if ($request->filled('my_full_name')) {
            return response()->json(['message' => 'Spam detected.'], 422);
        }

        return $next($request);
    }
}
