<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_name' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'excerpt' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['slug'] = \Illuminate\Support\Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');
        $data['is_featured'] = $request->has('is_featured');
        
        if ($data['is_published'] && !$request->published_at) {
            $data['published_at'] = now();
        }

        // Handle multiple images
        foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $data[$imgField] = $request->file($imgField)->store('articles', 'public');
            }
        }

        Article::create($data);

        // Hapus cache kategori karena ada data baru
        \Illuminate\Support\Facades\Cache::flush();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat!');
    }

    public function edit(Article $article)
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_name' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->all();
        
        // Update slug hanya jika judul berubah
        if ($article->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);
        }

        $data['is_published'] = $request->has('is_published');
        $data['is_featured'] = $request->has('is_featured');

        // Handle multiple images replacement
        foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
            if ($request->hasFile($imgField)) {
                if ($article->$imgField) {
                    Storage::disk('public')->delete($article->$imgField);
                }
                $data[$imgField] = $request->file($imgField)->store('articles', 'public');
            }
        }

        $article->update($data);

        // Hapus cache
        \Illuminate\Support\Facades\Cache::flush();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }
        $article->delete();

        // Hapus cache kategori
        \Illuminate\Support\Facades\Cache::forget('article_categories_count_v2');

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
