<?php

use Faker\Generator as Faker;
use App\Subscriber;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'number'     => $faker->unique()->phoneNumber(),
        'subscribed' => true,
        'referrer_id' => Subscriber::newReferrerId(),
    ];
});
