<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Article;
use App\Models\PageView;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'total_categories' => \App\Models\Category::count(),
            'total_interactions' => Article::sum('click_count') + Article::sum('whatsapp_clicks') + Article::sum('phone_clicks'),
            'today_hits' => PageView::where('type', 'view')->whereDate('created_at', now()->toDateString())->count(),
            'unread_messages' => \App\Models\ContactMessage::where('is_read', false)->count(),
            
            // Data untuk tabel terbaru
            'recent_articles' => Article::latest()->take(5)->get(),
            'top_performing_articles' => Article::orderBy('click_count', 'desc')->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
