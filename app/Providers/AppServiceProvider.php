<?php

namespace App\Providers;

use Illuminate\Http\Request;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        //
        if (!empty( env('NGROK_URL') )) {
            $this->app['url']->forceRootUrl(env('NGROK_URL'));
            $this->app['url']->forceScheme('https');
        }
    }
}
