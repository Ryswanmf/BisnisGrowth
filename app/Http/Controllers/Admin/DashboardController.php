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
            'total_businesses' => Business::count(),
            'total_articles' => Article::count(),
            'total_views' => PageView::count(),
            'recent_views' => PageView::with('business')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
