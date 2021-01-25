<?php

namespace App\Providers;

use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(
            TranslateClient::class,
            new TranslateClient([
                'keyFile' => json_decode(file_get_contents('/var/opt/google_keyfile.json'), true)
            ])
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
