<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'twilio_sid'        => $faker->md5(),
        'subscriber_number' => function () {
            return create('App\Subscriber')->number;
        },
        'incoming' => false,
        'to'       => $faker->phoneNumber(),
        'from'     => $faker->phoneNumber(),
        'body'     => $faker->sentence(),
    ];
});
