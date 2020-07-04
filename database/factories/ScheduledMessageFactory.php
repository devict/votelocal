<?php

use Faker\Generator as Faker;
use App\ScheduledMessage;

$factory->define(ScheduledMessage::class, function (Faker $faker) {
    return [
        'body_en' => $faker->text(160),
        'body_es' => $faker->text(160),
        'target_sms' => 1,
        'target_twitter' => 1,
        'send_at' => now()->addMinutes(1)->toDateTimeString(),
        'sent' => false,
    ];
});
