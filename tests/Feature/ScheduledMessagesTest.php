<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ScheduledMessage;
use App\Message;
use App\User;
use App\Tag;

class ScheduledMessagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin can create scheduled messages to be sent in the future
     *
     * @return void
     */
    public function testAdminCreateScheduledMessage()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $locationTag = factory(Tag::class)->create([ 'category' => 'location' ]);
        $topicTag = factory(Tag::class)->create([ 'category' => 'topic' ]);

        $tomorrow = today()->addDay();

        $response = $this
            ->actingAs($user)
            ->post('/admin/scheduled_messages', [
                'body_en'  => 'Test english',
                'body_es'  => 'Test spanish',
                'target_sms' => 1,
                'target_twitter' => 1,
                'send_at' => $tomorrow->toW3cString(),
                'tags' => [$locationTag->id, $topicTag->id],
            ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/admin/scheduled_messages');

        tap(ScheduledMessage::first(), function($message) use ($tomorrow) {
            $this->assertEquals('Test english', $message->body_en);
            $this->assertEquals('Test spanish', $message->body_es);
            $this->assertEquals(1, $message->target_sms);
            $this->assertEquals(1, $message->target_twitter);
            $this->assertEquals($tomorrow, $message->send_at);
            $this->assertEquals(false, $message->sent);
        });
    }

    /**
     * Tests that a scheduled message can't be created for a time in the past.
     *
     * @return void
     */
    public function testCantCreateScheduledMessageInThePast()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $message = factory(ScheduledMessage::class)->make([
            'send_at' => now()->subMinutes(1)->toDateTimeString(),
        ]);

        $response = $this
            ->actingAs($user)
            ->post('/admin/scheduled_messages', $message->toArray());

        $response->assertRedirect('/admin/scheduled_messages/new');

        $this->assertDatabaseMissing('scheduled_messages', [
            'body_en' => $message->body_en,
            'body_es' => $message->body_es,
            'send_at' => $message->send_at,
        ]);
    }

    /**
     * Test admin can edit a scheduled message.
     *
     * @return void
     */
    public function testAdminCanEditScheduledMessage()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $message = factory(ScheduledMessage::class)->create();

        $locationTag = factory(Tag::class)->create([ 'category' => 'location' ]);
        $topicTag = factory(Tag::class)->create([ 'category' => 'topic' ]);

        $newBodyEN = 'New!';
        $newBodyES = 'Nuevo!';

        $response = $this
            ->actingAs($user)
            ->put('/admin/scheduled_messages/' . $message->id, [
                'body_en' => $newBodyEN,
                'body_es' => $newBodyES,
                'target_sms' => 1,
                'target_twitter' => 0,
                'send_at' => $message->send_at,
                'tags' => [$locationTag->id, $topicTag->id],
            ]);

        $response->assertRedirect('/admin/scheduled_messages');

        $this->assertDatabaseHas('scheduled_messages', [
            'id' => $message->id,
            'body_en' => $newBodyEN,
            'body_es' => $newBodyES,
            'target_sms' => 1,
            'target_twitter' => 0,
            'send_at' => $message->send_at,
        ]);

        $this->assertDatabaseHas('scheduled_message_tag', [
            'tag_id' => $locationTag->id,
            'scheduled_message_id' => $message->id,
        ]);

        $this->assertDatabaseHas('scheduled_message_tag', [
            'tag_id' => $topicTag->id,
            'scheduled_message_id' => $message->id,
        ]);
    }

    /**
     * Test admin can delete a scheduled message.
     *
     * @return void
     */
    public function testAdminCanDeleteScheduledMessage()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $message = factory(ScheduledMessage::class)->create();
        $messageAttrCheck = [
            'id' => $message->id,
            'body_en' => $message->body_en,
            'body_es' => $message->body_es,
            // We don't check send at because the DB record includes seconds
        ];

        $this->assertDatabaseHas('scheduled_messages', $messageAttrCheck);

        $response = $this
            ->actingAs($user)
            ->get('/admin/scheduled_messages/' . $message->id . '/delete');

        $response->assertRedirect('/admin/scheduled_messages');
        $this->assertDatabaseMissing('scheduled_messages', $messageAttrCheck);
    }

    /**
     * Test admin can't edit or delete a scheduled message that has been sent.
     *
     * @return void
     */
    public function testCantChangeAlreadySentScheduledMessage()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $message = factory(ScheduledMessage::class)->create([
            'sent' => true,
            'send_at' => now()->subMinutes(1)->toDateTimeString(),
        ]);

        $messageAttrCheck = [
            'id' => $message->id,
            'body_en' => $message->body_en,
            'body_es' => $message->body_es,
        ];

        $this->assertDatabaseHas('scheduled_messages', $messageAttrCheck);

        $response = $this
            ->actingAs($user)
            ->get('/admin/scheduled_messages/' . $message->id . '/delete');

        $response->assertRedirect('/admin/scheduled_messages');
        $response->assertSessionHasErrors('cant_change_sent_message');
        $this->assertDatabaseHas('scheduled_messages', $messageAttrCheck);

        $response = $this
            ->actingAs($user)
            ->put('/admin/scheduled_messages/' . $message->id, [
                'body_en' => 'sup',
            ]);

        $response->assertRedirect('/admin/scheduled_messages');
        $response->assertSessionHasErrors('cant_change_sent_message');
        $this->assertDatabaseHas('scheduled_messages', $messageAttrCheck);
    }

    /**
     * Test viewing sent messages of a processed scheduled message.
     *
     * @return void
     */
    public function testViewMessagesOfSentScheduledMessage()
    {
        // create scheduled message and a few messages with it's id,
        $user = factory(User::class)->create([ 'admin' => true ]);
        $scheduled_message = factory(ScheduledMessage::class)->create([
            'sent' => true,
        ]);
        $messages = factory(Message::class, 3)->create([
            'scheduled_message_id' => $scheduled_message->id,
        ]);

        // go to /messages on the scheduled message
        $response = $this
            ->actingAs($user)
            ->get('/admin/scheduled_messages/'.$scheduled_message->id);

        // expect to see each of the messages sent
        foreach ($messages as $message) {
            $response->assertSee($message->body_en);
            $response->assertSee($message->body_es);
            $response->assertSee($message->to);
        }
    }

    // /**
    //  * Test scheduled messages are sent to all active subscribers, and to
    //  * no inactive subscribers.
    //  *
    //  * @return void
    //  */
    // public function testScheduledMessageOnlyGoesToActiveSubscribers()
    // {
    //     $this->assertTrue(false);
    // }
}
