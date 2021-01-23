<?php

namespace App\Events;

use App\Models\Translation;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TranslationCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Translation */
    private $translation;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Translation $translation)
    {
        $this->translation = $translation;
    }

    /**
     * @return Translation
     */
    public function getTranslation(): Translation
    {
        return $this->translation;
    }
}
