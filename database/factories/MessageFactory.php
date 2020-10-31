<?php

namespace Database\Factories;

use App\Message;
use App\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'twilio_sid' => $this->faker->md5(),
            'subscriber_number' => function () {
                return Subscriber::factory()->create()->number;
            },
            'incoming' => false,
            'to' => $this->faker->phoneNumber(),
            'from' => $this->faker->phoneNumber(),
            'body' => $this->faker->sentence(),
        ];
    }
}
