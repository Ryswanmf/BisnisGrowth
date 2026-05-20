<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $footerSetting = FooterSetting::first();

        return view('pages.contact', compact('footerSetting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return redirect()->back()->with(
    'success',
    'Pesan Anda berhasil terkirim! Tim kami akan segera menghubungi Anda.'
);
    }
}