<?php

namespace App\Http\Controllers;

use App\Http\Request\KeyCreateRequest;
use App\Http\Request\KeyUpdateRequest;
use App\Models\Key;

class KeyController extends Controller
{
    public function list()
    {
        return Key::all();
    }

    public function get(int $id)
    {
        return Key::findOrFail($id)->load('translations');
    }

    public function create(KeyCreateRequest $request)
    {
        return Key::create([
            'name' => $request->get('name')
        ]);
    }

    public function update(KeyUpdateRequest $request, int $id)
    {
        $key = Key::findOrFail($id);
        $key->name = $request->get('name');
        $key->save();

        return $key;
    }

    public function delete(int $id)
    {
        Key::findOrFail($id)->delete();
    }
}
