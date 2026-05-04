<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageView;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TrafficController extends Controller
{
    public function index()
    {
        // 1. Statistik Ringkas
        $stats = [
            'total_views' => PageView::where('type', 'view')->count(),
            'today_views' => PageView::where('type', 'view')->whereDate('created_at', Carbon::today())->count(),
            'unique_visitors' => PageView::distinct('ip_address')->count(),
            'avg_per_day' => round(PageView::where('type', 'view')->count() / max(PageView::distinct(DB::raw('DATE(created_at)'))->count(), 1), 1),
            'total_article_clicks' => Article::sum('click_count'),
            'total_wa_clicks' => Article::sum('whatsapp_clicks'),
            'total_phone_clicks' => Article::sum('phone_clicks'),
            'total_comments' => Comment::count(),
        ];

        // 2. Trend Harian (7 Hari Terakhir)
        $dailyTrend = collect(range(6, 0))->map(function ($days) {
            $date = Carbon::today()->subDays($days);
            $dateString = $date->toDateString();
            
            return [
                'label' => $date->translatedFormat('d M'),
                'views' => PageView::where('type', 'view')->whereDate('created_at', $dateString)->count(),
                'articles' => PageView::where('type', 'article')->whereDate('created_at', $dateString)->count(),
                'whatsapp' => PageView::where('type', 'whatsapp')->whereDate('created_at', $dateString)->count(),
                'phone' => PageView::where('type', 'phone')->whereDate('created_at', $dateString)->count(),
                'comments' => Comment::whereDate('created_at', $dateString)->count(),
            ];
        })->values();

        // 3. Trend Mingguan
        $weeklyTrend = collect(range(7, 0))->map(function ($weeks) {
            $start = Carbon::now()->subWeeks($weeks)->startOfWeek();
            $end = $start->copy()->endOfWeek();
            return $this->getMetricsForDateRange($start, $end, 'Minggu ' . $start->format('W'));
        })->values();

        // 4. Trend Bulanan
        $monthlyTrend = collect(range(11, 0))->map(function ($months) {
            $date = Carbon::now()->subMonths($months);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();
            return $this->getMetricsForDateRange($start, $end, $date->translatedFormat('M Y'));
        })->values();

        $devices = PageView::select('device', DB::raw('count(*) as total'))->groupBy('device')->get();
        $topPages = PageView::select('url', DB::raw('count(*) as total'))->groupBy('url')->orderBy('total', 'desc')->take(5)->get();
        $topDomains = Domain::leftJoin('domain_traffic_logs', 'domains.id', '=', 'domain_traffic_logs.domain_id')
            ->select('domains.*', DB::raw('SUM(domain_traffic_logs.hits) as hits_count'))
            ->groupBy('domains.id', 'domains.name', 'domains.url', 'domains.is_active', 'domains.click_count', 'domains.created_at', 'domains.updated_at')
            ->orderBy('hits_count', 'desc')
            ->take(10)
            ->get();

        $seoData = Article::published()
            ->select('title', 'slug', 'canonical_url')
            ->paginate(10);

        return view('admin.traffic.index', compact('stats', 'dailyTrend', 'weeklyTrend', 'monthlyTrend', 'devices', 'topPages', 'topDomains', 'seoData'));
    }

    private function getMetricsForDateRange($start, $end, $label)
    {
        return [
            'label' => $label,
            'views' => PageView::where('type', 'view')->whereBetween('created_at', [$start, $end])->count(),
            'articles' => PageView::where('type', 'article')->whereBetween('created_at', [$start, $end])->count(),
            'whatsapp' => PageView::where('type', 'whatsapp')->whereBetween('created_at', [$start, $end])->count(),
            'phone' => PageView::where('type', 'phone')->whereBetween('created_at', [$start, $end])->count(),
            'comments' => Comment::whereBetween('created_at', [$start, $end])->count(),
        ];
    }
}
