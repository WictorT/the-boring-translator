<?php

namespace App\Http\Controllers;

use App\Http\Request\KeyCreateRequest;
use App\Http\Request\KeyUpdateRequest;
use App\Models\Key;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function list()
    {
        return Language::all();
    }
}
