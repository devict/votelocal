<?php

namespace App\Services\Sms;

use Illuminate\Support\ServiceProvider;
use App\Services\Sms\Contracts\Sms;
use App\Services\Sms\TwilioAdapter;

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
