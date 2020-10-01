<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

use App\Subscriber;
use App\ScheduledMessage;
use App\Observers\SubscriberObserver;
use App\Observers\ScheduledMessageObserver;

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
        ScheduledMessage::observe(ScheduledMessageObserver::class);

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
