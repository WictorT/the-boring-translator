<?php

namespace App\Events;

use App\Builders\ExportBuilder;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
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
     * @return void
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
