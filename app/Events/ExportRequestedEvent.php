<?php

namespace App\Events;

use App\Builders\ExportBuilder;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportRequestedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var ExportBuilder */
    private $exportBuilder;

    /**
     * Create a new event instance.
     *
     * @param ExportBuilder $exportBuilder
     */
    public function __construct(ExportBuilder $exportBuilder)
    {
        $this->exportBuilder = $exportBuilder;
    }

    /**
     * @return ExportBuilder
     */
    public function getExportBuilder(): ExportBuilder
    {
        return $this->exportBuilder;
    }
}
