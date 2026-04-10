<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $query = Article::published();

        // Ambil kategori dengan jumlah artikel secara efisien (Cache selama 30 menit)
        $categoriesData = \Illuminate\Support\Facades\Cache::remember('article_categories_count_v2', 1800, function() {
            return Article::published()
                ->select('category_name', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('category_name')
                ->get()
                ->toArray(); // Simpan sebagai array agar aman di cache
        });

        $categoriesWithCount = collect($categoriesData);
        $totalArticles = $categoriesWithCount->sum('total');

        // Filter berdasarkan pencarian...
        if ($request->has('q')) {
            $search = $request->get('q');
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->has('category')) {
            $query->where('category_name', $request->get('category'));
        }

        // Urutan (default terbaru)
        $sort = $request->get('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderBy('view_count', 'desc');
        } else {
            $query->latest('published_at');
        }

        $articles = $query->paginate(12)->withQueryString();
        
        return view('pages.articles.index', compact('articles', 'categoriesWithCount', 'totalArticles'));
    }

    /**
     * Display the specified article.
     */
    public function show(Article $article)
    {
        // Increment view count
        $article->increment('view_count');

        // Get related articles (same category, excluding current article)
        $relatedArticles = Article::published()
            ->where('category_name', $article->category_name)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(6)
            ->get();

        // If not enough related articles by category, fill with latest articles
        if ($relatedArticles->count() < 6) {
            $extraArticles = Article::published()
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->latest('published_at')
                ->take(6 - $relatedArticles->count())
                ->get();
            
            $relatedArticles = $relatedArticles->merge($extraArticles);
        }

        return view('pages.articles.show', compact('article', 'relatedArticles'));
    }
}
