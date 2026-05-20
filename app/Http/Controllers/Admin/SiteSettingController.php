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
    $tables = \DB::select('SHOW TABLES');

    $databaseName = config('database.connections.mysql.database');

    $sqlScript = '';

    foreach ($tables as $table) {

        $tableName = array_values((array)$table)[0];

        // Struktur tabel
        $createTable = \DB::select("SHOW CREATE TABLE `$tableName`");

        $sqlScript .= "\n\n" . $createTable[0]->{'Create Table'} . ";\n\n";

        // Data tabel
        $rows = \DB::table($tableName)->get();

        foreach ($rows as $row) {

            $row = (array)$row;

            $columns = array_map(function ($value) {
                return '`' . $value . '`';
            }, array_keys($row));

            $values = array_map(function ($value) {

                if ($value === null) {
                    return 'NULL';
                }

                return "'" . addslashes($value) . "'";

            }, array_values($row));

            $sqlScript .= "INSERT INTO `$tableName` ("
                . implode(', ', $columns)
                . ") VALUES ("
                . implode(', ', $values)
                . ");\n";
        }
    }

    $fileName = 'backup-' . now()->format('Y-m-d-H-i-s') . '.sql';

    return response($sqlScript)
        ->header('Content-Type', 'application/sql')
        ->header('Content-Disposition', 'attachment; filename="'.$fileName.'"');
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
