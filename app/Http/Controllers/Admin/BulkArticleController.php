<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Domain;
use App\Models\ShortKeyword;
use App\Helpers\ContentHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class BulkArticleController extends Controller
{
    /**
     * Tampilkan form bulk generator.
     */
    public function index()
    {
        $categories = Category::all();
        $domains = Domain::where('is_active', true)->orderBy('name')->get();
        $shortKeywords = ShortKeyword::where('is_active', true)->orderBy('title')->get();
        return view('admin.articles.bulk', compact('categories', 'domains', 'shortKeywords'));
    }

    /**
     * Native PHP Image Optimization (Convert to WebP & Resize)
     */
    private function optimizeAndStore($file)
    {
        $extension = $file->getClientOriginalExtension();

        $filename = time() . '_' . Str::random(10) . '_' . Str::slug(
            pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
        ) . '.' . $extension;

        $directory = $_SERVER['DOCUMENT_ROOT'] . '/uploads/articles';

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $file->move($directory, $filename);

        return 'uploads/articles/' . $filename;
    }

    /**
     * Proses generate artikel massal.
     */
    public function store(Request $request)
    {
        $request->validate([
            'spintax_title' => 'required|string',
            'spintax_excerpt' => 'nullable|string',
            'spintax_content' => 'required|string',
            'spintax_meta_title' => 'nullable|string',
            'spintax_meta_description' => 'nullable|string',
            'keywords' => 'required|string',
            'domain_url' => 'nullable|string',
            'bulk_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            // Schedule Fields
            'schedule_mode' => 'required|in:interval,range',
            'batch_size' => 'nullable|integer|min:1',
            'interval_minutes' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date',
            'category_name' => 'nullable|string|required_if:schedule_mode,interval',
            'category_name_range' => 'nullable|string|required_if:schedule_mode,range',
        ]);

        // 1. Handle Bulk Images Upload
        $uploadedImages = [];
        if ($request->hasFile('bulk_images')) {
            foreach ($request->file('bulk_images') as $imageFile) {
                $path = $this->optimizeAndStore($imageFile);
                if ($path) {
                    $uploadedImages[] = $path;
                }
            }
        }

        // 2. Pecah keyword berdasarkan baris baru
        $keywords = preg_split('/\r\n|\r|\n/', $request->keywords);
        $keywords = array_filter(array_map('trim', $keywords));
        $keywords = array_values($keywords); // Reset index

        if (empty($keywords)) {
            return back()->with('error', 'Silakan masukkan minimal satu keyword.');
        }

        $totalKeywords = count($keywords);
        $scheduleMode = $request->schedule_mode;
        $categoryName = ($scheduleMode === 'range') ? $request->category_name_range : $request->category_name;
        
        // Logika Penjadwalan
        $publishDates = [];
        if ($scheduleMode === 'range') {
            try {
                // Ambil tanggal mulai dan selesai, pastikan dalam Carbon
                $start = Carbon::parse($request->start_date);
                $end = Carbon::parse($request->end_date);
                
                // Jika end_date sebelum atau sama dengan start_date
                if ($end->timestamp <= $start->timestamp) {
                    return back()->with('error', 'Tanggal selesai harus setelah tanggal mulai.');
                }

                $totalSeconds = $end->timestamp - $start->timestamp;
                
                // Interval antar artikel dalam detik (pembagi total - 1)
                $step = ($totalKeywords > 1) ? ($totalSeconds / ($totalKeywords - 1)) : 0;
                
                for ($i = 0; $i < $totalKeywords; $i++) {
                    // Gunakan timestamp untuk kalkulasi agar tidak meleset
                    $targetTimestamp = $start->timestamp + round($i * $step);
                    $publishDates[] = Carbon::createFromTimestamp($targetTimestamp);
                }

                \Illuminate\Support\Facades\Log::info('Bulk Schedule Range Success:', [
                    'start' => $start->toDateTimeString(),
                    'end' => $end->toDateTimeString(),
                    'count' => $totalKeywords,
                    'step_seconds' => $step
                ]);

            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal memproses rentang tanggal: ' . $e->getMessage());
                return back()->with('error', 'Terjadi kesalahan saat menghitung jadwal. Mohon pastikan format tanggal benar.');
            }
        } else {
            $batchSize = (int) ($request->batch_size ?? 10);
            $interval = (int) ($request->interval_minutes ?? 5);
            $now = Carbon::now();
            
            for ($i = 0; $i < $totalKeywords; $i++) {
                $batchIndex = floor($i / $batchSize);
                $publishDates[] = $now->copy()->addMinutes($batchIndex * $interval);
            }
        }

        $count = 0;
        foreach ($keywords as $index => $keyword) {
            $publishTime = $publishDates[$index];

            // Persiapkan variabel pengganti [keyword]
            $replaceKeyword = function($text) use ($keyword) {
                return str_ireplace('[keyword]', $keyword, $text);
            };

            // Gabungkan spintax judul dengan keyword agar lebih tertarget
            $rawTitle = $request->spintax_title;
            if (!str_contains(strtolower($rawTitle), '[keyword]')) {
                $rawTitle .= ' ' . $keyword;
            } else {
                $rawTitle = $replaceKeyword($rawTitle);
            }
            
            // Proses spintax untuk semua field
            $title = ContentHelper::processSpintax($rawTitle);
            $content = ContentHelper::processSpintax($replaceKeyword($request->spintax_content));
            
            // Handle Excerpt
            $excerpt = $request->spintax_excerpt ? ContentHelper::processSpintax($replaceKeyword($request->spintax_excerpt)) : Str::limit(strip_tags($content), 160);

            // Handle SEO Meta
            $metaTitle = $request->spintax_meta_title ? ContentHelper::processSpintax($replaceKeyword($request->spintax_meta_title)) : $title;
            $metaDescription = $request->spintax_meta_description ? ContentHelper::processSpintax($replaceKeyword($request->spintax_meta_description)) : $excerpt;

            // Handle Canonical URL
            $canonicalUrl = null;
            if ($request->domain_url) {
                $slug = Str::slug($keyword . '-' . Str::random(5));
                $canonicalUrl = rtrim($request->domain_url, '/') . '/artikel/' . $slug;
            } else {
                $slug = Str::slug($keyword . '-' . Str::random(5));
            }

            // Pilih Gambar Acak untuk 4 slot jika tersedia
            $imageData = [];
            if (!empty($uploadedImages)) {
                $pool = $uploadedImages;
                shuffle($pool);
                
                $imageData['image'] = $pool[0] ?? null;
                $imageData['image_2'] = $pool[1] ?? null;
                $imageData['image_3'] = $pool[2] ?? null;
                $imageData['image_4'] = $pool[3] ?? null;
            } else {
                $imageData['image'] = 'https://source.unsplash.com/featured/800x600?business,marketing&sig=' . rand(1, 9999);
            }

            $articleData = array_merge([
                'user_id' => auth()->id(),
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt,
                'content' => $content,
                'category_name' => $categoryName,
                'status' => 'publish',
                'published_at' => $publishTime,
                'is_published' => true,
                'is_featured' => false,
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'canonical_url' => $canonicalUrl,
            ], $imageData);

            $article = Article::create($articleData);

            // Sync Short Keywords
            if ($request->has('short_keyword_ids')) {
                $article->shortKeywords()->sync($request->short_keyword_ids);
            }

            $count++;
        }

        // Hapus Cache
        Cache::flush();

        $msg = ($scheduleMode === 'range') 
            ? "Berhasil men-generate $count artikel. Artikel dijadwalkan terbit merata mulai " . Carbon::parse($request->start_date)->format('d M Y H:i') . " sampai " . Carbon::parse($request->end_date)->format('d M Y H:i') . "."
            : "Berhasil men-generate $count artikel. Artikel akan terbit secara bertahap (Batch: {$request->batch_size}, Jeda: {$request->interval_minutes} menit).";

        return redirect()->route('admin.articles.index')->with('success', $msg);
    }
}
