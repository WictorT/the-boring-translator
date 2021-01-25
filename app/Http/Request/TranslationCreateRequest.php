<?php


namespace App\Http\Request;


class TranslationCreateRequest extends TranslationUpdateRequest
{
    public function rules(): array
    {
        return parent::rules() + [
                'language_iso_code' => 'required|string|size:2|exists:languages,iso_code',
            ];
    }
}
