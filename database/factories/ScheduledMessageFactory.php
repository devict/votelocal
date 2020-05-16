<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\ScheduledMessage::class, function (Faker $faker) {
    return [
        'body_en' => $faker->text(160),
        'body_es' => $faker->text(160),
        'target_sms' => true,
        'send_at' => Carbon::create()->addMinutes(1)->toDateTimeString(),
        'sent' => false,
    ];
});
