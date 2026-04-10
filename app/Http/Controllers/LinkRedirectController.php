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
        $link->business()->increment('click_count');

        return redirect()->away($link->url);
    }
}
