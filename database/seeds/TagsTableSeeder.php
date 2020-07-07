<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Kansas',
            'category' => 'location',
            'subscriber_default' => true,
            'message_default' => true,
        ]);
        Tag::create([
            'name' => 'Wichita',
            'category' => 'location',
            'subscriber_default' => true,
            'message_default' => false,
        ]);
        Tag::create([
            'name' => 'Voting Reminders',
            'category' => 'topic',
            'subscriber_default' => true,
            'message_default' => false,
        ]);
        Tag::create([
            'name' => 'Candidate Info',
            'category' => 'topic',
            'subscriber_default' => true,
            'message_default' => false,
        ]);
        Tag::create([
            'name' => 'Informative Events',
            'category' => 'topic',
            'subscriber_default' => true,
            'message_default' => false,
        ]);
    }
}
