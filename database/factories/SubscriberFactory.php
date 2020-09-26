<?php

use App\Subscriber;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'number' => $faker->unique()->phoneNumber(),
        'subscribed' => true,
        'referrer_id' => Subscriber::newReferrerId(),
    ];
});
