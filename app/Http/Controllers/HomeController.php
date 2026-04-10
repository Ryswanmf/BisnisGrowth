<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\PageView;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'total_businesses' => Business::where('is_active', true)->count(),
            'total_categories' => Category::where('is_active', true)->count(),
            'total_views' => Business::sum('view_count'),
        ];

        $featuredBusinesses = Business::with('category')
            ->where('is_active', true)
            ->orderBy('is_verified', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $popularCategories = Category::where('is_active', true)
            ->orderBy('order', 'asc')
            ->take(8)
            ->get();

        return view('pages.home', compact('stats', 'featuredBusinesses', 'popularCategories'));
    }
}
