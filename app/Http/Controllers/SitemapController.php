<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Page;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $articles = Article::published()->latest()->get();
        $pages = Page::where('is_published', true)->get();
        $businesses = \App\Models\Business::where('is_active', true)->get();
        $categories = \App\Models\Category::where('is_active', true)->get();

        $content = view('sitemap', compact('articles', 'pages', 'businesses', 'categories'))->render();

        return response($content, 200)->header('Content-Type', 'text/xml');
    }
}
