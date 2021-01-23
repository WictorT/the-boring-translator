<?php

namespace Tests\Unit\Listeners;

use App\Events\TranslationCreatedEvent;
use App\Listeners\AutoUpdateTranslationsListener;
use App\Models\Translation;
use Tests\TestCase;

class AutoUpdateTranslationsTest extends TestCase
{
    public function testHandle()
    {
        /** @var Translation $translation */
        $translation = Translation::factory()->create();

        $translation->refresh();
//        TODO mock
        (new AutoUpdateTranslationsListener)->handle(new TranslationCreatedEvent($translation));

        self::assertCount(5, $translation->key->translations);
    }
}
