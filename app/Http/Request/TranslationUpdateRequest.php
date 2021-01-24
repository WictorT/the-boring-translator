<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class TranslationUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => 'required|string',
        ];
    }
}
