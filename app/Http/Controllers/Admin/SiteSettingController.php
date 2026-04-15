<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SiteSettingController extends Controller
{
    public function backupDatabase()
    {
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');
        $dbHost = config('database.connections.mysql.host');
        
        $fileName = 'backup-' . $dbName . '-' . date('Y-m-d-H-i-s') . '.sql';
        $filePath = storage_path('app/' . $fileName);

        // Perintah mysqldump (Pastikan mysqldump terinstall di server/path)
        $command = "mysqldump --user=$dbUser --password=$dbPass --host=$dbHost $dbName > $filePath";
        
        // Khusus untuk Windows/Laragon, kita bungkus password dengan tanda kutip jika perlu
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = "mysqldump --user=$dbUser --password=\"$dbPass\" --host=$dbHost $dbName > \"$filePath\"";
        }

        exec($command);

        if (file_exists($filePath)) {
            return response()->download($filePath)->deleteFileAfterSend(true);
        }

        return redirect()->back()->with('error', 'Gagal membuat backup database. Pastikan mysqldump tersedia di server Anda.');
    }

    public function index()
    {
        // Ambil semua setting dan jadikan key => value array
        $settings = SiteSetting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('_token', '_method');

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Bersihkan cache agar perubahan langsung terasa
        Cache::flush();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
    }
}
