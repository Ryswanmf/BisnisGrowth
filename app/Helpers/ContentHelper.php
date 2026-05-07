<?php

namespace App\Helpers;

use App\Models\Article;

class ContentHelper
{
    /**
     * Get the correct image URL regardless of storage path.
     */
    public static function imageUrl($path)
    {
        if (empty($path)) return null;
        
        if (str_starts_with($path, 'http')) {
            return $path;
        }

        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        return asset('storage/' . $path);
    }

    /**
     * Process all dynamic elements in the text.
     */
    public static function process($text, Article $article = null, $appendKeywords = true)
    {
        if (empty($text)) return '';

        // 1. Process Spintax {a|b|c}
        $text = self::processSpintax($text);

        // 2. Prepare Keyword Pool if Article exists
        $keywordPool = [];
        if ($article && $article->shortKeywords()->count() > 0) {
            foreach ($article->shortKeywords as $pool) {
                if (!$pool->is_active) continue;
                $variations = preg_split('/[,\n\r]+/', $pool->description);
                $keywordPool = array_merge($keywordPool, array_filter(array_map('trim', $variations)));
            }
        }

        // 3. Process Internal Linking (Auto-link keywords)
        if ($appendKeywords) { // Only apply to content, not titles
            $internalLinks = \Illuminate\Support\Facades\Cache::remember('internal_links_v2', 3600, function() {
                return \App\Models\InternalLink::where('is_active', true)
                    ->select('keyword', 'url', 'limit')
                    ->get()
                    ->toArray();
            });

            if (is_array($internalLinks)) {
                foreach ($internalLinks as $link) {
                    if (!isset($link['keyword']) || !isset($link['url'])) continue;
                    
                    $quotedKeyword = preg_quote($link['keyword'], '/');
                    // Regex: match word but not inside tags like <a>, <img>, etc.
                    $pattern = '/(?!(?:[^<]+>|[^>]*<\/a>))\b(' . $quotedKeyword . ')\b/i';
                    $text = preg_replace($pattern, '<a href="' . $link['url'] . '" class="text-amber-600 font-bold hover:underline" title="$1">$1</a>', $text, $link['limit'] ?? 1);
                }
            }
        }

        // 4. Process [keyword] shortcode
        $text = preg_replace_callback('/\[keyword\]/', function() use (&$keywordPool) {
            if (empty($keywordPool)) return '';
            $randomKey = array_rand($keywordPool);
            return self::processSpintax($keywordPool[$randomKey]);
        }, $text);

        // 4. Process Native [related id="XX"]
        $text = preg_replace_callback('/\[related id="(\d+)"\]/', function($matches) {
            $articleId = $matches[1];
            $related = Article::find($articleId);
            if ($related) {
                $url = route('article.show', $related->slug);
                return '
                <div class="not-prose my-4">
                    <a href="'.$url.'" class="group flex items-center gap-4 px-5 py-3 bg-slate-50 border-l-4 border-amber-500 rounded-xl hover:bg-amber-50 transition-all border border-gray-100 shadow-sm">
                        <div class="h-8 w-8 bg-amber-100 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="h-4 w-4 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div class="flex-1">
                            <span class="block text-[9px] font-black text-amber-600 uppercase tracking-widest mb-0.5">Baca Juga:</span>
                            <h4 class="text-sm font-bold text-slate-900 leading-tight group-hover:text-amber-700 transition-colors line-clamp-1">'.$related->title.'</h4>
                        </div>
                    </a>
                </div>';
            }
            return '';
        }, $text);

        // 5. Process Automatic Keyword Injection (at the bottom) - Only if appendKeywords is true
        if ($appendKeywords && !empty($keywordPool)) {
            // Cek menggunakan ID khusus agar tidak terjadi duplikasi meskipun class CSS berubah
            if (!str_contains($text, 'id="article-hashtags"')) {
                shuffle($keywordPool);
                $finalKeywords = [];
                
                // Ambil maksimal 20-30 variasi
                foreach (array_slice($keywordPool, 0, 30) as $rawKeyword) {
                    // Jalankan spintax pada setiap keyword
                    $spun = self::processSpintax($rawKeyword);
                    
                    // Bersihkan spasi agar jadi format tagar yang benar (misal: "Jasa Web" -> "JasaWeb")
                    $cleanHashtag = str_replace(' ', '', ucwords($spun));
                    if (!empty($cleanHashtag)) {
                        $finalKeywords[] = $cleanHashtag;
                    }
                }
                
                $finalKeywords = array_unique($finalKeywords);
                if (!empty($finalKeywords)) {
                    $hashtagString = '#' . implode(' #', $finalKeywords);
                    $keywordHtml = '<div id="article-hashtags" class="mt-10 pt-6 border-t border-gray-100 text-xs text-gray-400 italic font-medium leading-relaxed">' . $hashtagString . '</div>';
                    $text .= $keywordHtml;
                }
            }
        }

        return $text;
    }

    /**
     * Process Spintax {a|b|c} in the text.
     * Supports nested spintax like {A|{B|C}}.
     * 
     * @param string $text
     * @return string
     */
    public static function processSpintax($text)
    {
        if (empty($text) || !str_contains($text, '{')) {
            return $text;
        }

        $callback = function ($match) {
            $parts = explode('|', $match[1]);
            return trim($parts[array_rand($parts)]);
        };

        // Loop until no more {} are found to support nested spintax
        while (str_contains($text, '{') && str_contains($text, '}')) {
            $newText = preg_replace_callback('/\{([^{}]+)\}/', $callback, $text);
            if ($newText === $text) break; // Break if no more replacements possible
            $text = $newText;
        }

        return $text;
    }
}
