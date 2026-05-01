<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InternalLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InternalLinkController extends Controller
{
    public function index()
    {
        $links = InternalLink::latest()->get();
        return view('admin.internal-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.internal-links.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|unique:internal_links,keyword',
            'url' => 'required|url',
            'limit' => 'required|integer|min:1|max:10',
        ]);

        InternalLink::create([
            'keyword' => $request->keyword,
            'url' => $request->url,
            'limit' => $request->limit,
            'is_active' => $request->has('is_active'),
        ]);

        Cache::forget('internal_links_v1');
        return redirect()->route('admin.internal-links.index')->with('success', 'Tautan internal berhasil ditambahkan!');
    }

    public function edit(InternalLink $internalLink)
    {
        return view('admin.internal-links.edit', compact('internalLink'));
    }

    public function update(Request $request, InternalLink $internalLink)
    {
        $request->validate([
            'keyword' => 'required|string|unique:internal_links,keyword,' . $internalLink->id,
            'url' => 'required|url',
            'limit' => 'required|integer|min:1|max:10',
        ]);

        $internalLink->update([
            'keyword' => $request->keyword,
            'url' => $request->url,
            'limit' => $request->limit,
            'is_active' => $request->has('is_active'),
        ]);

        Cache::forget('internal_links_v1');
        return redirect()->route('admin.internal-links.index')->with('success', 'Tautan internal berhasil diperbarui!');
    }

    public function destroy(InternalLink $internalLink)
    {
        $internalLink->delete();
        Cache::forget('internal_links_v1');
        return redirect()->route('admin.internal-links.index')->with('success', 'Tautan internal berhasil dihapus!');
    }
}
