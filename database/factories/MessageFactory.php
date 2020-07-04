<?php

use Faker\Generator as Faker;
use App\Subscriber;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'twilio_sid'        => $faker->md5(),
        'subscriber_number' => function () {
            return factory(Subscriber::class)->create()->number;
        },
        'incoming' => false,
        'to'       => $faker->phoneNumber(),
        'from'     => $faker->phoneNumber(),
        'body'     => $faker->sentence(),
    ];
});
