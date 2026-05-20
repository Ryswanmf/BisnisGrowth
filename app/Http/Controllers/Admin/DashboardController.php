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
            'top_performing_articles' => Article::published()
    ->orderByDesc('click_count')
    ->take(5)
    ->get(),
            'top_domains' => \App\Models\Domain::where('is_active', true)
                ->leftJoin('domain_traffic_logs', 'domains.id', '=', 'domain_traffic_logs.domain_id')
                ->select('domains.*', \Illuminate\Support\Facades\DB::raw('SUM(domain_traffic_logs.hits) as hits_count'))
                ->groupBy('domains.id', 'domains.name', 'domains.url', 'domains.is_active', 'domains.click_count', 'domains.created_at', 'domains.updated_at')
                ->orderBy('hits_count', 'desc')
                ->take(5)
                ->get(),
        ];

        // Data Traffic 7 Hari Terakhir
        $trafficLabels = [];
        $trafficValues = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $trafficLabels[] = $date->translatedFormat('d M');
            $trafficValues[] = PageView::whereDate('created_at', $date->toDateString())->count();
        }
        $stats['chart_labels'] = $trafficLabels;
        $stats['chart_values'] = $trafficValues;

        return view('admin.dashboard', compact('stats'));
    }
}
