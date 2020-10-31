<?php

namespace Tests\Feature;

use App\ScheduledMessage;
use App\Services\Sms\Contracts\Sms;
use App\Services\Sms\FakeAdapter;
use App\Subscriber;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Swap Twilio adapter with a fake one
        $this->sms = new FakeAdapter;
        $this->app->instance(Sms::class, $this->sms);
    }

    public function testScheduledMessageOnlyGoesToActiveSubscribers()
    {
        $topic = Tag::factory()->create(['category' => 'topic']);
        $location = Tag::factory()->create(['category' => 'location']);

        $subscriber = Subscriber::factory()->withTags([$topic, $location])->create();
        $unsubscribed = Subscriber::factory()->withTags([$topic, $location])->unsubscribed()->create();
        ScheduledMessage::factory()->withTags([$topic, $location])->create([
            'body_en' => 'Testing',
            'sent' => false,
            'send_at' => now()->subHour()->toDateTimeString(),
        ]);

        $this->artisan('send-scheduled-messages');

        $this->assertDatabaseHas('messages', [
            'to' => $subscriber->number,
            'body' => 'Testing',
            'incoming' => false,
        ]);

        $this->assertDatabaseMissing('messages', [
            'to' => $unsubscribed->number,
        ]);
    }
}
