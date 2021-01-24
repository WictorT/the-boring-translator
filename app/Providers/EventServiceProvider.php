<?php

namespace App\Providers;

use App\Events\TranslationCreatedEvent;
use App\Listeners\AutoUpdateTranslationsListener;
use App\Events\ExportRequestedEvent;
use App\Listeners\CreateZipArchiveListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TranslationCreatedEvent::class => [
            AutoUpdateTranslationsListener::class,
        ],
        ExportRequestedEvent::class => [
            CreateZipArchiveListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
