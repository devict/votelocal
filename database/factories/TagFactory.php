<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'category' => $faker->randomElement(array_keys(Tag::categoryOptions())),
    ];
});
