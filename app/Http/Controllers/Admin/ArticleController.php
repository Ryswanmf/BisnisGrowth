<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Native PHP Image Optimization (Convert to WebP & Resize)
     * Langsung ke folder PUBLIC untuk kemudahan di cPanel
     */
    private function optimizeAndStore($file)
    {
        $filename = Str::random(30) . '.webp';
        $directory = public_path('uploads/articles');
        $fullPath = $directory . '/' . $filename;

        // Pastikan direktori ada
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Ambil info gambar
        $info = getimagesize($file->getRealPath());
        $mime = $info['mime'];

        // Buat resource gambar berdasarkan tipe asli
        switch ($mime) {
            case 'image/jpeg': $image = imagecreatefromjpeg($file->getRealPath()); break;
            case 'image/png':  $image = imagecreatefrompng($file->getRealPath()); break;
            case 'image/webp': $image = imagecreatefromwebp($file->getRealPath()); break;
            default: 
                return null; // Tolak jika bukan format yang didukung
        }

        // Resize jika lebar > 1200px
        $origWidth = imagesx($image);
        $origHeight = imagesy($image);
        if ($origWidth > 1200) {
            $newWidth = 1200;
            $newHeight = floor($origHeight * ($newWidth / $origWidth));
            $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
            
            if ($mime == 'image/png') {
                imagealphablending($tmpImg, false);
                imagesavealpha($tmpImg, true);
            }
            
            imagecopyresampled($tmpImg, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
            imagedestroy($image);
            $image = $tmpImg;
        }

        // Simpan sebagai WebP (Kualitas 80)
        imagewebp($image, $fullPath, 80);
        imagedestroy($image);

        return 'uploads/articles/' . $filename;
    }

    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        $domains = \App\Models\Domain::where('is_active', true)->orderBy('name')->get();
        $shortKeywords = \App\Models\ShortKeyword::where('is_active', true)->orderBy('title')->get();
        return view('admin.articles.create', compact('categories', 'domains', 'shortKeywords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_name' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'required|in:publish,draft,private',
            'published_at' => 'nullable|date',
        ]);

        try {
            $data = $request->all();
            $data['user_id'] = auth()->id();
            $data['slug'] = Str::slug($request->title);
            $data['status'] = $request->status;
            $data['is_published'] = ($request->status === 'publish');
            $data['is_featured'] = $request->has('is_featured');
            
            // Handle publishing date
            if ($request->status === 'publish' && !$request->published_at) {
                $data['published_at'] = now();
            }

            foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
                if ($request->hasFile($imgField)) {
                    $savedPath = $this->optimizeAndStore($request->file($imgField));
                    if ($savedPath) {
                        $data[$imgField] = $savedPath;
                    }
                }
            }

            $article = Article::create($data);
            if ($request->has('short_keyword_ids')) {
                $article->shortKeywords()->sync($request->short_keyword_ids);
            }
            
            // Hapus cache halaman utama dan kategori
            \Illuminate\Support\Facades\Cache::flush();
            
            return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal menyimpan artikel: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal menyimpan artikel: ' . $e->getMessage());
        }
    }

    public function edit(Article $article)
    {
        $categories = \App\Models\Category::where('is_active', true)->orderBy('name')->get();
        $domains = \App\Models\Domain::where('is_active', true)->orderBy('name')->get();
        $shortKeywords = \App\Models\ShortKeyword::where('is_active', true)->orderBy('title')->get();
        return view('admin.articles.edit', compact('article', 'categories', 'domains', 'shortKeywords'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_name' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'status' => 'required|in:publish,draft,private',
            'published_at' => 'nullable|date',
        ]);

        try {
            $data = $request->all();
            if ($article->title !== $request->title) $data['slug'] = Str::slug($request->title);
            $data['status'] = $request->status;
            $data['is_published'] = ($request->status === 'publish');
            $data['is_featured'] = $request->has('is_featured');

            // Handle publishing date
            if ($request->status === 'publish' && !$request->published_at && !$article->published_at) {
                $data['published_at'] = now();
            }

            foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
                if ($request->hasFile($imgField)) {
                    if ($article->$imgField && File::exists(public_path($article->$imgField))) {
                        File::delete(public_path($article->$imgField));
                    }
                    $savedPath = $this->optimizeAndStore($request->file($imgField));
                    if ($savedPath) {
                        $data[$imgField] = $savedPath;
                    }
                }
            }

            $article->update($data);
            if ($request->has('short_keyword_ids')) {
                $article->shortKeywords()->sync($request->short_keyword_ids);
            } else {
                $article->shortKeywords()->detach();
            }
            \Illuminate\Support\Facades\Cache::flush();
            return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal memperbarui artikel: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui artikel: ' . $e->getMessage());
        }
    }

    public function destroy(Article $article)
    {
        foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
            if ($article->$imgField && File::exists(public_path($article->$imgField))) {
                File::delete(public_path($article->$imgField));
            }
        }
        $article->delete();
        \Illuminate\Support\Facades\Cache::forget('article_categories_count_v2');
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
