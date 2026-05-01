<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Business;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class OgImageController extends Controller
{
    public function generate(Request $request, $type, $id)
    {
        // 1. Get Data based on type
        $title = "BisnisGrowth";
        $backgroundImage = null;
        $category = "Edukasi Bisnis";

        if ($type === 'article') {
            $data = Article::findOrFail($id);
            $title = $data->title;
            $backgroundImage = $data->image;
            $category = $data->category_name;
        } elseif ($type === 'business') {
            $data = Business::findOrFail($id);
            $title = $data->name;
            $backgroundImage = $data->cover_image;
            $category = $data->category->name ?? 'Direktori Bisnis';
        }

        // 2. Create Canvas (Standard OG Size: 1200x630)
        $img = Image::create(1200, 630);

        // 3. Add Background
        if ($backgroundImage && file_exists(public_path($backgroundImage))) {
            $bg = Image::read(public_path($backgroundImage))->cover(1200, 630);
            $img->place($bg);
            // Add Dark Overlay for readability
            $img->fill('rgba(0, 0, 0, 0.6)');
        } else {
            // Default elegant gradient-like background
            $img->fill('#0f172a'); // Slate 900
        }

        // 4. Add Decorative Border/Line
        $img->drawRectangle(0, 0, function($draw) {
            $img->fill('rgba(245, 158, 11, 0.5)', 0, 620, 1200, 630); // Amber bottom line
        });

        // 5. Add Logo (Bottom Right)
        $logoPath = public_path('images/Logo_Bisnis_Growth.png');
        if (file_exists($logoPath)) {
            $logo = Image::read($logoPath)->scale(height: 50);
            $img->place($logo, 'bottom-right', 50, 50);
        }

        // 6. Add Category Badge
        $img->text(strtoupper($category), 60, 150, function($font) {
            $font->size(24);
            $font->color('#f59e0b'); // Amber 500
            $font->weight('black');
        });

        // 7. Add Main Title (with wrapping logic)
        $wrappedTitle = wordwrap($title, 35, "\n");
        $img->text($wrappedTitle, 60, 230, function($font) {
            $font->size(60);
            $font->color('#ffffff');
            $font->weight('black');
            $font->lineHeight(1.2);
        });

        // 8. Add Website URL
        $img->text('bisnisgrowth.id', 60, 550, function($font) {
            $font->size(20);
            $font->color('rgba(255, 255, 255, 0.4)');
            $font->weight('bold');
        });

        return $img->response('png');
    }
}
