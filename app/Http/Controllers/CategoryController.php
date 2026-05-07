<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        if (!$category->is_active) {
            abort(404);
        }

        $businesses = $category->businesses()
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('pages.category', compact('category', 'businesses'));
    }
}
