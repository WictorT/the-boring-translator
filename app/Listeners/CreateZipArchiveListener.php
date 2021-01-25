<?php

namespace App\Listeners;

use App\Events\ExportRequestedEvent;

class CreateZipArchiveListener
{
    /**
     * Handle the event.
     *
     * @param ExportRequestedEvent $event
     * @return void
     */
    public function handle(ExportRequestedEvent $event)
    {
        $event->getExportBuilder()
            ->groupKeys()
            ->prepareJson()
            ->prepareYaml()
            ->exportZip();
    }
}
