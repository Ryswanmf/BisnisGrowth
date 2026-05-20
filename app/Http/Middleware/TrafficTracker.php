<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageView;
use App\Models\Domain;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrafficTracker
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jalankan request terlebih dahulu
        $response = $next($request);

        // Hanya catat request GET dan bukan rute admin/api/asset
        if (
    $request->isMethod('GET')
    && !$request->is('admin*')
    && !$request->is('article/*/track-click')
) {
            
            $ip = $request->ip();
            $url = $request->fullUrl();
            $host = $request->getHost();
            
            // Throttling: 1 log per IP per URL per 15 menit agar tidak memenuhi DB
            $cacheKey = 'track_' . md5($ip . $url);
            
            if (!Cache::has($cacheKey)) {
                // Catat di PageView (Log Detail)
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

                // Hitung Klik Per Domain (SEO Analytics)
                // Cari domain yang cocok dengan host saat ini
                $domainRecord = Domain::where('url', 'LIKE', "%{$host}%")->where('is_active', true)->first();
                if ($domainRecord) {
                    $domainRecord->increment('click_count');

                    // Catat Log Harian Detail
                    \App\Models\DomainTrafficLog::updateOrCreate(
                        ['domain_id' => $domainRecord->id, 'date' => now()->toDateString()],
                        ['hits' => \Illuminate\Support\Facades\DB::raw('hits + 1')]
                    );
                }

                Cache::put($cacheKey, true, now()->addMinutes(15));
            }
        }

        return $response;
    }
}
