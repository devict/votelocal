<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Twilio\Rest\TwilioClient as TwilioClient;

class TwilioServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('twilio', function () {
            return new TwilioClient(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
        });
    }
}
