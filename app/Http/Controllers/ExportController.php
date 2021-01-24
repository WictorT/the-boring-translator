<?php

namespace App\Http\Controllers;

use App\Builders\ExportBuilder;
use App\Events\ExportRequestedEvent;
use App\Models\Key;

class ExportController extends Controller
{
    public function export()
    {
        $keys = Key::all()->load('translations');

        $exportBuilder = (new ExportBuilder)->setKeys($keys);

        ExportRequestedEvent::dispatch($exportBuilder);

        return response()->json([
            'download_link' => route('web.download.translations', [
                'download_key' => $exportBuilder->getExportKey(),
            ])
        ]);
    }

    public function download(string $downloadKey)
    {
        return response()->download(storage_path("app/$downloadKey.zip"));
    }
}
