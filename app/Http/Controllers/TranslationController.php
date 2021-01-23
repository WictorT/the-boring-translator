<?php

namespace App\Http\Controllers;

use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Support\Facades\Auth;

class TranslationController extends Controller
{
    public function index()
    {
        dd(Auth::user());

        $translate = new TranslateClient([
            'keyFile' => json_decode(file_get_contents('/var/opt/google_keyfile.json'), true)
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
