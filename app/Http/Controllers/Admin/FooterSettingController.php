<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            $directory = public_path('uploads/footer');
            
            // Pastikan direktori ada
            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0755, true);
            }

            // Hapus logo lama
            if ($setting->logo && File::exists(public_path($setting->logo))) {
                File::delete(public_path($setting->logo));
            }

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($directory, $filename);
            
            $data['logo'] = 'uploads/footer/' . $filename;
        }

        $setting->fill($data);
        $setting->save();

        // Hapus cache agar perubahan langsung terlihat
        \Illuminate\Support\Facades\Cache::forget('footer_settings_v2');

        return redirect()->back()->with('success', 'Pengaturan footer berhasil diperbarui!');
    }
}
