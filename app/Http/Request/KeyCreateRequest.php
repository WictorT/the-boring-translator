<?php


namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class KeyCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:keys,name',
        ];
    }
}
