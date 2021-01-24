<?php

namespace App\Http\Controllers;

use App\Models\Language;

class LanguageController extends Controller
{
    public function list()
    {
        return Language::all();
    }
}
