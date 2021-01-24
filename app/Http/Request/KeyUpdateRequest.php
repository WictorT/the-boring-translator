<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class KeyUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:keys,name',
        ];
    }
}
