<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'twilio_sid'    => $faker->phoneNumber(),
        'subscriber_id' => function () {
            return create('App\Subscriber')->id;
        },
        'incoming' => false,
        'to'       => $faker->phoneNumber(),
        'from'     => $faker->phoneNumber(),
        'body'     => $faker->sentence(),
    ];
});
