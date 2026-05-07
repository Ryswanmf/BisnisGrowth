<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $featuredArticles = Article::published()->where('is_featured', true)->latest('published_at')->take(5)->get();
        $featuredIds = $featuredArticles->pluck('id');
        
        $sidebar = Article::published()
            ->whereNotIn('id', $featuredIds)
            ->latest('published_at')->take(3)->get();
        $sidebarIds = $sidebar->pluck('id');

        $latestPaginator = Article::published()
            ->whereNotIn('id', $featuredIds)
            ->whereNotIn('id', $sidebarIds)
            ->latest('published_at')->paginate(8);

        $data = [
            'featuredArticles' => $featuredArticles,
            'sidebarArticles' => $sidebar,
            'articlesData' => $latestPaginator->items(), 
            'links' => $latestPaginator->links()->toHtml(),
        ];

        return view('pages.home', $data);
    }
}
