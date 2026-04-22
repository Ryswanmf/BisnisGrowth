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
                  ->orWhere('excerpt', 'LIKE', "%{$search}%")
                  ->orWhere('category_name', 'LIKE', "%{$search}%");
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
        } elseif ($sort === 'oldest') {
            $query->orderBy('published_at', 'asc');
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
        // Load author
        $article->load('user');

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

        // Get popular articles (by view_count)
        $popularArticles = Article::published()
            ->where('id', '!=', $article->id)
            ->orderBy('view_count', 'desc')
            ->take(5)
            ->get();

        // Hitung estimasi waktu baca (rata-rata 200 kata per menit)
        $wordCount = str_word_count(strip_tags($article->content));
        $readingTime = max(1, ceil($wordCount / 200));

        return view('pages.articles.show', compact('article', 'relatedArticles', 'popularArticles', 'readingTime'));
    }

    public function trackClick(Request $request, Article $article)
    {
        // ... kode yang sudah ada ...
    }

    public function storeComment(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'content' => 'required|string|max:1000',
        ]);

        $article->comments()->create([
            'name' => $request->name,
            'content' => $request->content,
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success_comment', 'Terima kasih! Komentar Anda telah berhasil dikirim.');
    }
}
