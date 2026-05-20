<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\PageView;


class ArticleController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        // Jika user login, mereka bisa melihat artikel publish (yang sudah waktunya) & private
        $query = Article::query();
        if (auth()->check()) {
            $query->where(function($q) {
                $q->published()->orWhere('status', 'private');
            });
        } else {
            $query->published();
        }

        // Ambil kategori dengan jumlah artikel secara efisien (Cache selama 30 menit)
        $categoriesData = \Illuminate\Support\Facades\Cache::remember('article_categories_count_v2', 1800, function() {
            return Article::published()
                ->select('category_name', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('category_name')
                ->get()
                ->toArray();
        });

        $categoriesWithCount = collect($categoriesData);
        $totalArticles = $categoriesWithCount->sum('total');

        // Filter berdasarkan pencarian...
        if ($request->filled('q')) {
            $search = trim($request->get('q'));
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%")
                  ->orWhere('category_name', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
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

    public function liveSearch(Request $request)
    {
        $search = trim($request->get('q'));
        
        if (strlen($search) < 2) {
            return response()->json([]);
        }

        // Jika user login, mereka bisa melihat artikel publish & private
        $query = Article::query();
        if (auth()->check()) {
            $query->where(function($q) {
                $q->published()->orWhere('status', 'private');
            });
        } else {
            $query->published();
        }

        $articles = $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('category_name', 'LIKE', "%{$search}%");
            })
            ->latest('published_at')
            ->take(6)
            ->get();

        $results = $articles->map(function($article) {
            return [
                'title' => $article->title, // Sudah diproses via accessor di Model
                'url' => route('article.show', $article->slug),
                'category' => $article->category_name,
                'image' => $article->image 
                ? \App\Helpers\ContentHelper::imageUrl($article->image) 
                : null,
            ];
        });

        return response()->json($results);
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        
//        if (
//    !empty($article->canonical_url) &&
//    filter_var($article->canonical_url, FILTER_VALIDATE_URL) &&
//    parse_url($article->canonical_url, PHP_URL_HOST) !== request()->getHost()
//) {
//
//    return redirect()->away($article->canonical_url, 301);
//}
//    
        // Proteksi: Jika tidak publish, hanya admin atau pemilik yang bisa lihat
        if ($article->status !== 'publish' || ($article->published_at && $article->published_at->isFuture())) {
            if (!auth()->check() || (auth()->user()->role !== 'admin' && auth()->id() !== $article->user_id)) {
                abort(404);
            }
        }

        // Jika privat, hanya user terdaftar (login) yang bisa lihat
        if ($article->status === 'private' && !auth()->check()) {
            return redirect()->route('login')->with('info', 'Silakan login untuk membaca artikel privat ini.');
        }

        // Load author
        $article->load('user');

        // Increment view count
        $article->increment('view_count');

        // Process title and content with ContentHelper (Internal Links, Spintax, Keywords)
        $article->title = \App\Helpers\ContentHelper::process($article->title, $article, false);
        $article->content = \App\Helpers\ContentHelper::process($article->content, $article);

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

   public function trackClick(Request $request, $id)
{
    try {

        $type = $request->input('type');

        // Tambahkan ini
        if ($type === 'article') {
            Article::where('id', $id)
                ->increment('click_count');
        }

        PageView::create([
            'type' => $type,
            'url' => $request->header('referer'),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'device' => 'Desktop',
            'referrer' => $request->header('referer'),
            'created_at' => now()
        ]);

        return response()->json([
            'success' => true
        ]);

    } catch (\Exception $e) {

        \Log::error($e->getMessage());

        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
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
