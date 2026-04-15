<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        $cacheKey = 'home_final_array_v6_' . $page;

        // Ambil data mentah (Array) dari cache
        $data = Cache::remember($cacheKey, 900, function() {
            $featured = Article::published()->where('is_featured', true)->latest('published_at')->first();
            
            $sidebar = Article::published()
                ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
                ->latest('published_at')->take(3)->get();

            $latestPaginator = Article::published()
                ->when($featured, fn($q) => $q->where('id', '!=', $featured->id))
                ->whereNotIn('id', $sidebar->pluck('id'))
                ->latest('published_at')->paginate(8);

            // Ubah semua objek menjadi array mentah agar aman di cache
            return [
                'featuredArticle' => $featured ? $featured->toArray() : null,
                'sidebarArticles' => $sidebar->toArray(),
                'articlesData' => $latestPaginator->items() ? json_decode(json_encode($latestPaginator->items()), true) : [], 
                'links' => $latestPaginator->links()->toHtml()
            ];
        });

        // Validasi Ekstra: Jika data rusak, paksa hapus
        if (!is_array($data) || (isset($data['featuredArticle']) && !is_array($data['featuredArticle']) && !is_null($data['featuredArticle']))) {
            Cache::forget($cacheKey);
            return redirect()->refresh();
        }

        return view('pages.home', $data);
    }
}
