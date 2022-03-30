<?php

namespace App\Providers;

use App\Images;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $versionIdentifier = '';
        if (File::exists(base_path('.version'))) {
            $versionIdentifier = substr(File::get(base_path('.version')), 0, 7);
        }

        view()->share('versionIdentifier', $versionIdentifier);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->isLocal()) {
        //if local register your services you require for development
            $this->app->register('Barryvdh\Debugbar\ServiceProvider');
        } else {
        //else register your services you require for production
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
