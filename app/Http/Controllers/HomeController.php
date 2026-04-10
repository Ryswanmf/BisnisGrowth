<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Business;
use App\Models\Category;
use App\Models\PageView;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredArticle = Article::published()
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        // Ambil 3 artikel terbaru untuk sidebar (kecuali yang jadi featured)
        $sidebarArticles = Article::published()
            ->when($featuredArticle, fn($q) => $q->where('id', '!=', $featuredArticle->id))
            ->latest('published_at')
            ->take(3)
            ->get();

        // Ambil sisa artikel untuk grid utama dengan pagination
        $articles = Article::published()
            ->when($featuredArticle, fn($q) => $q->where('id', '!=', $featuredArticle->id))
            ->whereNotIn('id', $sidebarArticles->pluck('id'))
            ->latest('published_at')
            ->paginate(8); // Menampilkan 8 artikel per halaman

        return view('pages.home', compact('featuredArticle', 'sidebarArticles', 'articles'));
    }
}
