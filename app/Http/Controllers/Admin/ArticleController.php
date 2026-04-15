<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Services\GeminiService;

class ArticleController extends Controller
{
    protected $aiService;

    public function __construct(GeminiService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Native PHP Image Optimization (Convert to WebP & Resize)
     */
    private function optimizeAndStore($file)
    {
        $filename = Str::random(30) . '.webp';
        $path = 'articles/' . $filename;
        $fullPath = storage_path('app/public/' . $path);

        if (!Storage::disk('public')->exists('articles')) {
            Storage::disk('public')->makeDirectory('articles');
        }

        // Ambil info gambar
        $info = getimagesize($file->getRealPath());
        $mime = $info['mime'];

        // Buat resource gambar berdasarkan tipe asli
        switch ($mime) {
            case 'image/jpeg': $image = imagecreatefromjpeg($file->getRealPath()); break;
            case 'image/png':  $image = imagecreatefrompng($file->getRealPath()); break;
            case 'image/webp': $image = imagecreatefromwebp($file->getRealPath()); break;
            default: return $file->store('articles', 'public'); // Simpan asli jika format tak dikenal
        }

        // Resize jika lebar > 1200px
        $origWidth = imagesx($image);
        $origHeight = imagesy($image);
        if ($origWidth > 1200) {
            $newWidth = 1200;
            $newHeight = floor($origHeight * ($newWidth / $origWidth));
            $tmpImg = imagecreatetruecolor($newWidth, $newHeight);
            
            // Handle transparansi untuk PNG
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

        return $path;
    }

    public function generateAI(Request $request)
    {
        $request->validate(['topic' => 'required|string|max:255']);
        $result = $this->aiService->generateArticle($request->topic);
        if (isset($result['error'])) return response()->json(['error' => $result['error']], 500);
        return $result ? response()->json($result) : response()->json(['error' => 'Gagal mendapatkan respon dari AI'], 500);
    }

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');
        $data['is_featured'] = $request->has('is_featured');
        
        if ($data['is_published'] && !$request->published_at) $data['published_at'] = now();

        foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $data[$imgField] = $this->optimizeAndStore($request->file($imgField));
            }
        }

        Article::create($data);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $data = $request->all();
        if ($article->title !== $request->title) $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');
        $data['is_featured'] = $request->has('is_featured');

        foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
            if ($request->hasFile($imgField)) {
                if ($article->$imgField) Storage::disk('public')->delete($article->$imgField);
                $data[$imgField] = $this->optimizeAndStore($request->file($imgField));
            }
        }

        $article->update($data);
        \Illuminate\Support\Facades\Cache::flush();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        foreach(['image', 'image_2', 'image_3', 'image_4'] as $imgField) {
            if ($article->$imgField) Storage::disk('public')->delete($article->$imgField);
        }
        $article->delete();
        \Illuminate\Support\Facades\Cache::flush();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
