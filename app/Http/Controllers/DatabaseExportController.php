<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DatabaseExportController extends Controller
{
    public function exportDatabase()
{
    $dbName = env('DB_DATABASE');
    $user = env('DB_USERNAME');
    $password = env('DB_PASSWORD');
    $host = env('DB_HOST');

    $fileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
    $filePath = storage_path("app/{$fileName}");

    $command = "mysqldump --user={$user} --password={$password} --host={$host} {$dbName} > {$filePath}";

    $result = null;
    $output = [];
    exec($command, $output, $result);

    if ($result === 0) {
        return response()->download($filePath)->deleteFileAfterSend(true);
    } else {
        return back()->with('error', 'Database export failed.');
    }
}
}
