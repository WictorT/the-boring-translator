<?php

namespace App\Http\Controllers;

use App\Events\TranslationCreatedEvent;
use App\Http\Request\TranslationCreateRequest;
use App\Http\Request\TranslationUpdateRequest;
use App\Models\Key;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class TranslationController extends Controller
{
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

        $translation = null;
        DB::transaction(function () use ($translations, $request, &$translation) {
            $translation = $translations->save(
                new Translation([
                    'language_iso_code' => $request->get('language_iso_code'),
                    'value' => $request->get('value')
                ])
            );

            TranslationCreatedEvent::dispatch($translation);
        });

        return $translation;
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
