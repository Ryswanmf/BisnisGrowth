<?php

namespace App\Helpers;

use App\Models\Article;

class ContentHelper
{
    public static function process($text)
    {
        if (empty($text)) return '';

        // 1. Process Spintax {a|b|c}
        $text = self::processSpintax($text);

        // 2. Process Shortcode [related id="XX"]
        $text = self::processShortcodes($text);

        return $text;
    }

    private static function processSpintax($text)
    {
        return preg_replace_callback(
            '/\{([^{}]+)\}/',
            function ($match) {
                $parts = explode('|', $match[1]);
                return $parts[array_rand($parts)];
            },
            $text
        );
    }

    private static function processShortcodes($text)
    {
        return preg_replace_callback('/\[related id="(\d+)"\]/', function($matches) {
            $articleId = $matches[1];
            $article = Article::find($articleId);

            if ($article) {
                $url = route('article.show', $article->slug);
                $title = $article->title; // Menggunakan accessor agar spintax diproses
                
                return '
                <div class="not-prose my-2">
                    <a href="'.$url.'" class="group flex items-center gap-3 px-4 py-2 bg-slate-50 border-l-2 border-amber-500 rounded-lg hover:bg-amber-50 transition-all border border-gray-100">
                        <span class="text-[8px] font-black text-amber-600 uppercase tracking-widest whitespace-nowrap">Baca Juga:</span>
                        <h4 class="text-xs font-bold text-slate-900 leading-none group-hover:text-amber-700 transition-colors line-clamp-1">'.$title.'</h4>
                    </a>
                </div>';
            }
            return '';
        }, $text);
    }
}
