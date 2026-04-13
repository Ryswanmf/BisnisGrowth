<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FooterSettingController extends Controller
{
    public function edit()
    {
        // Ambil data pertama atau buat objek baru jika kosong
        $setting = FooterSetting::first() ?? new FooterSetting();
        return view('admin.footer.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'about_text' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'copyright_text' => 'nullable|string|max:255',
        ]);

        $setting = FooterSetting::first() ?: new FooterSetting();
        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            // Hapus logo lama
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $data['logo'] = $request->file('logo')->store('footer', 'public');
        }

        $setting->fill($data);
        $setting->save();

        // Hapus cache agar perubahan langsung terlihat
        \Illuminate\Support\Facades\Cache::forget('footer_settings_v2');

        return redirect()->back()->with('success', 'Pengaturan footer berhasil diperbarui!');
    }
}
