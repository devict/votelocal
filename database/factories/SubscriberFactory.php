<?php

use Faker\Generator as Faker;

$factory->define(App\Subscriber::class, function (Faker $faker) {
    return [
        'number' => $faker->phoneNumber(),
        'subscribed' => true,
    ];
});
