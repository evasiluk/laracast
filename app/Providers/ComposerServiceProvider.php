<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

//        view()->composer('shared.navbar', function($view) {
//            $view->with('notify_qnt', 20);
//        });

        view()->composer('shared.navbar', 'App\Http\View\Composers\NotificationsComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
