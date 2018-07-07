<?php

namespace App\Services\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\Sms\Contracts\Sms',
            'App\Services\Sms\TwilioAdapter'
        );
    }
}
