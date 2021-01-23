<?php

namespace App\Listeners;

use App\Events\TranslationCreatedEvent;
use App\Models\Language;
use App\Models\Translation;
use Google\Cloud\Translate\V2\TranslateClient;

class AutoUpdateTranslationsListener
{
    /** @var TranslateClient */
    private $translateClient;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->translateClient = new TranslateClient([
            'keyFile' => json_decode(file_get_contents('/var/opt/google_keyfile.json'), true)
        ]);
    }

    /**
     * Handle the event.
     *
     * @param TranslationCreatedEvent $event
     * @return void
     */
    public function handle(TranslationCreatedEvent $event)
    {
        $sourceTranslation = $event->getTranslation();
        $targetLanguages = Language::all()->filter(function (Language $targetLanguage) use ($sourceTranslation) {
            return $targetLanguage->iso_code !== $sourceTranslation->language_iso_code;
        });

        $newTranslations = $targetLanguages->map(function (Language $targetLanguage) use ($sourceTranslation) {
            $clientTranslation = $this->translateClient->translate(
                $sourceTranslation->value,
                [
                    'source' => $sourceTranslation->language_iso_code,
                    'target' => $targetLanguage->iso_code,
                ]
            );

            return new Translation([
                'language_iso_code' => $targetLanguage->iso_code,
                'value' => $clientTranslation['text'],
            ]);
        });

        $sourceTranslation->key->translations()->saveMany($newTranslations);
    }
}
