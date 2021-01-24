<?php

namespace App\Http\Controllers;

use App\Models\Key;
use App\Service\ExportBuilder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class ExportController extends Controller
{
    public function export()
    {
        $keys = Key::all()->load('translations');

        $exportKey = (new ExportBuilder)
            ->setKeys($keys)
            ->prepareJson()
            ->prepareYaml()
            ->exportZip()
            ->getExportKey();

        return response()->json([
            'download_link' => route('web.download.translations', [
                'download_key' => $exportKey,
            ])
        ]);
    }

    public function download(string $downloadKey)
    {
        return response()->download(storage_path("app/$downloadKey.zip"));
    }
}
