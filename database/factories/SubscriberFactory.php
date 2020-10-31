<?php

namespace Database\Factories;

use App\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriberFactory extends Factory
{
    protected $model = Subscriber::class;

    public function unsubscribed()
    {
        return $this->state(function (array $attributes) {
            return [
                'subscribed' => false,
            ];
        });
    }

    public function withTags($tags)
    {
        return $this->afterCreating(function ($subscriber) use ($tags) {
            $subscriber->tags()->attach(array_map(fn ($tag) => $tag->id, $tags));
        });
    }

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'number' => $this->faker->unique()->phoneNumber(),
            'subscribed' => true,
            'referrer_id' => Subscriber::newReferrerId(),
        ];
    }
}
