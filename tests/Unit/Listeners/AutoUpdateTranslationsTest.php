<?php

namespace Tests\Unit\Listeners;

use App\Events\TranslationCreatedEvent;
use App\Listeners\AutoUpdateTranslationsListener;
use App\Models\Translation;
use Google\Cloud\Translate\V2\TranslateClient;
use Mockery;
use Tests\TestCase;

class AutoUpdateTranslationsTest extends TestCase
{
    public function testHandle()
    {
        /** @var Translation $translation */
        $translation = Translation::factory()->create();

        $this->instance(
            TranslateClient::class,
            Mockery::mock(TranslateClient::class, function (Mockery\MockInterface $mock) {
                $mock->shouldReceive('translate')
                    ->andReturn([
                        'text' => "Gryphon, with a soldier on each side, and opened their eyes and mouths so VERY much out of sight: then it chuckled. 'What fun!' said the King. (The jury all looked puzzled.) 'He must have a prize.",
                    ]);
            })
        );

        (new AutoUpdateTranslationsListener)->handle(new TranslationCreatedEvent($translation));

        self::assertCount(5, $translation->key->translations);
    }
}
