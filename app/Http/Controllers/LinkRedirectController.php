<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Link;
use Illuminate\Http\Request;

class LinkRedirectController extends Controller
{
    public function redirect(Link $link)
    {
        // Increment link click count
        $link->increment('click_count');
        
        // Also increment parent business total click count
        $business = $link->business;
        $business->increment('click_count');

        $url = $link->url;

        // Smart WhatsApp Message logic
        // Only append if it's a wa.me link and doesn't already have a message
        if (str_contains($url, 'wa.me') && !str_contains($url, 'text=')) {
            $businessName = $business->name;
            $message = "Halo {$businessName}, saya menemukan profil Anda di BisnisGrowth dan ingin bertanya tentang produk/layanan Anda.";
            
            // Check for existing query params
            $separator = str_contains($url, '?') ? '&' : '?';
            $url .= $separator . "text=" . urlencode($message);
        }

        return redirect()->away($url);
    }
}
