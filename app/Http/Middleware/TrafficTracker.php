<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageView;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrafficTracker
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jalankan request terlebih dahulu
        $response = $next($request);

        // Hanya catat request GET dan bukan rute admin/api/asset
        if ($request->isMethod('GET') && !$request->is('admin*') && !$request->ajax()) {
            
            $ip = $request->ip();
            $url = $request->fullUrl();
            
            // Throttling: 1 log per IP per URL per 15 menit agar tidak memenuhi DB
            $cacheKey = 'track_' . md5($ip . $url);
            
            if (!Cache::has($cacheKey)) {
                $userAgent = $request->userAgent();
                
                // Deteksi Device Sederhana
                $device = 'Desktop';
                if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $userAgent)) {
                    $device = 'Mobile';
                }

                PageView::create([
                    'type' => 'view',
                    'url' => $request->path() ?: '/',
                    'ip_address' => $ip,
                    'user_agent' => $userAgent,
                    'device' => $device,
                    'referrer' => $request->header('referer'),
                    'created_at' => now()
                ]);

                Cache::put($cacheKey, true, now()->addMinutes(15));
            }
        }

        return $response;
    }
}
