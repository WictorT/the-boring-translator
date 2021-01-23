<?php

namespace App\Http\Controllers;

use App\Http\Request\TranslationCreateRequest;
use App\Http\Request\TranslationUpdateRequest;
use App\Models\Key;
use App\Models\Language;
use App\Models\Translation;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TranslationController extends Controller
{
    public function index()
    {
        dd(Language::count());

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

    public function create(TranslationCreateRequest $request, int $keyId)
    {
        $key = Key::findOrFail($keyId);

        /** @var HasMany $translations */
        $translations = $key->translations();
        $translationExists = (boolean)$translations->where([
            'language_iso_code' => $request->get('language_iso_code'),
        ])->first();

        if ($translationExists) {
            throw new BadRequestHttpException("Translation for this key, for this language already exists.");
        }

        return $translations->save(
            new Translation([
                'language_iso_code' => $request->get('language_iso_code'),
                'value' => $request->get('value')
            ])
        );
    }

    public function update(TranslationUpdateRequest $request, int $keyId, int $translationId)
    {
        /** @var Translation $translation */
        $translation = Translation::where([
            "id" => $translationId,
            "key_id" => $keyId,
        ])->firstOrFail();

        $translation->update([
            'value' => $request->get('value')
        ]);

        return $translation;
    }

}
