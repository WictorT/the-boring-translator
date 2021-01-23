<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TranslationUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => 'required|string',
        ];
    }
}
