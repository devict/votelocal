<?php

namespace App\Services\Sms;

use App\Services\Sms\Contracts\Sms;
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
        $this->app->bind(Sms::class, TwilioAdapter::class);
    }
}
