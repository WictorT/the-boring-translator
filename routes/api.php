<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    Route::middleware('can:read')->group(function () {
        Route::get('/languages', 'App\Http\Controllers\LanguageController@list');

        Route::get('/keys', 'App\Http\Controllers\KeyController@list');
        Route::get('/keys/{id}', 'App\Http\Controllers\KeyController@get')->where('id', '[0-9]+');
    });

    Route::middleware('can:write')->group(function () {
        Route::post('/keys', 'App\Http\Controllers\KeyController@create');
        Route::put('/keys/{id}', 'App\Http\Controllers\KeyController@update')->where('id', '[0-9]+');
        Route::delete('/keys/{id}', 'App\Http\Controllers\KeyController@delete')->where('id', '[0-9]+');

        Route::post('/keys/{key_id}/translations', 'App\Http\Controllers\TranslationController@create');
        Route::put('/keys/{key_id}/translations/{translation_id}', 'App\Http\Controllers\TranslationController@update');
    });
});
