<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Business;
use App\Models\Category;
use App\Models\PageView;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'home_data_page_v2_' . $page;

        // Ambil data dari cache
        $data = \Illuminate\Support\Facades\Cache::remember($cacheKey, 900, function() {
            return $this->getHomeData();
        });

        // Validasi: Jika data di cache bukan array atau contains incomplete objects, refresh cache
        if (!is_array($data) || (isset($data['featuredArticle']) && !($data['featuredArticle'] instanceof \App\Models\Article) && !is_null($data['featuredArticle']))) {
            \Illuminate\Support\Facades\Cache::forget($cacheKey);
            $data = $this->getHomeData();
        }

        return view('pages.home', $data);
    }

    private function getHomeData()
    {
        $featured = Article::published()
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        $sidebar = Article::published()
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->latest('published_at')
            ->take(3)
            ->get();

        $latest = Article::published()
            ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
            ->whereNotIn('id', $sidebar->pluck('id'))
            ->latest('published_at')
            ->paginate(8);

        return [
            'featuredArticle' => $featured,
            'sidebarArticles' => $sidebar,
            'articles' => $latest
        ];
    }
}
