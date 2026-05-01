<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShortKeyword;
use Illuminate\Http\Request;

class ShortKeywordController extends Controller
{
    public function index()
    {
        $keywords = ShortKeyword::latest()->get();
        return view('admin.short-keywords.index', compact('keywords'));
    }

    public function create()
    {
        return view('admin.short-keywords.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        ShortKeyword::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.short-keywords.index')->with('success', 'Short Keyword berhasil ditambahkan!');
    }

    public function edit(ShortKeyword $shortKeyword)
    {
        return view('admin.short-keywords.edit', compact('shortKeyword'));
    }

    public function update(Request $request, ShortKeyword $shortKeyword)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $shortKeyword->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.short-keywords.index')->with('success', 'Short Keyword berhasil diperbarui!');
    }

    public function destroy(ShortKeyword $shortKeyword)
    {
        $shortKeyword->delete();
        return redirect()->route('admin.short-keywords.index')->with('success', 'Short Keyword berhasil dihapus!');
    }
}
