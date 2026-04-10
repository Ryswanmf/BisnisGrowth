<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BusinessProfileController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $business = Business::with(['category', 'links' => function($query) {
                $query->where('is_active', true)->orderBy('order', 'asc');
            }])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Throttling: 1 view per IP per hour per business
        $cacheKey = "viewed_{$business->id}_" . $request->ip();
        if (!Cache::has($cacheKey)) {
            // Increment view count
            $business->increment('view_count');

            // Log to page_views
            PageView::create([
                'business_id' => $business->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'referrer' => $request->header('referer'),
                'created_at' => now(),
            ]);

            Cache::put($cacheKey, true, now()->addHour());
        }

        return view('profile.show', compact('business'));
    }
}
