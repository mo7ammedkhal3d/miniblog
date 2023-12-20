<?php

namespace App\Providers;

use App\Custom\DateTime;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Custom\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('App\Custom\Application', function () {
            return new Application;
        });
        $this->app->singleton('App\Custom\DateTime', function(){
            return new DateTime;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $view->with('application', new Application);
            $view->with('dateHelper',new DateTime);
        });
    }
}
