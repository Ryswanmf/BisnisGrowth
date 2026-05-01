<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function index()
    {
        $domains = Domain::latest()->paginate(10);
        return view('admin.domains.index', compact('domains'));
    }

    public function create()
    {
        return view('admin.domains.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        Domain::create([
            'name' => $request->name,
            'url' => $request->url,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.domains.index')->with('success', 'Domain berhasil ditambahkan!');
    }

    public function edit(Domain $domain)
    {
        return view('admin.domains.edit', compact('domain'));
    }

    public function update(Request $request, Domain $domain)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url|max:255',
        ]);

        $domain->update([
            'name' => $request->name,
            'url' => $request->url,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.domains.index')->with('success', 'Domain berhasil diperbarui!');
    }

    public function destroy(Domain $domain)
    {
        $domain->delete();
        return redirect()->route('admin.domains.index')->with('success', 'Domain berhasil dihapus!');
    }
}
