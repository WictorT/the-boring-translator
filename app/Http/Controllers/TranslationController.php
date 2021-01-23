<?php

namespace App\Http\Controllers;

use Google\Cloud\Translate\V2\TranslateClient;

class TranslationController extends Controller
{
    public function index()
    {
//        dd(Storage::disk('local')->get('google_keyfile.json'));
        dd(json_decode(file_get_contents('/var/opt/google_keyfile.json'), true));


        $translate = new TranslateClient([
            'keyFile' => json_decode(file_get_contents(storage_path() . '/google_keyfile.json'), true)
        ]);

        dump(
        // Translate text from english to french.
            $translate->translate('Hello world!', ['target' => 'fr']),
            // Detect the language of a string.
            $translate->detectLanguage('Greetings from Michigan!'),
            // Get the languages supported for translation specifically for your target language.
            $translate->localizedLanguages(['target' => 'en']),
            // Get all languages supported for translation.
            $translate->languages()
        );
    }
}
