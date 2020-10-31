<?php

namespace App\Providers;

use App\Observers\SubscriberObserver;
use App\Subscriber;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') == 'production') {
            URL::forceScheme('https');
        }

        $locale = Request::segment(1);
        if (in_array($locale, config('votelocal.locales'))) {
            App::setLocale($locale);
        }

        Subscriber::observe(SubscriberObserver::class);

        Paginator::defaultView('partials.pagination');
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
