<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Register the repository
         */
        $this->app->bind(
            AuthRepository::class,
        );
    }

    public function boot()
    {
        if(env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}
