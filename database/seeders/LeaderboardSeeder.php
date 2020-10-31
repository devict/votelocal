<?php

namespace Database\Seeders;

use App\Subscriber;
use Illuminate\Database\Seeder;

class LeaderboardSeeder extends Seeder
{
    public function run()
    {
        Subscriber::factory()->create();
        foreach (range(1, 49) as $i) {
            Subscriber::factory()->create([
                'referred_by' => Subscriber::all()->random()->referrer_id,
                'pledged' => true,
                'hide_from_pledge_board' => false,
            ]);
        }
    }
}
