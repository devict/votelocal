<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\ScheduledMessage;
use App\Message;
use App\User;

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
        $message = factory(ScheduledMessage::class)->make();

        $request = $this
            ->actingAs($user)
            ->post('/admin/scheduled_messages', $message->toArray());

        $request->assertRedirect('/admin/scheduled_messages');

        $this->assertDatabaseHas('scheduled_messages', [
            'body' => $message->body,
            'send_at' => $message->send_at,
            'sent' => false,
        ]);
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
            'send_at' => Carbon::create()->subMinutes(1)->toDateTimeString(),
        ]);

        $request = $this
            ->actingAs($user)
            ->post('/admin/scheduled_messages', $message->toArray());

        $request->assertRedirect('/admin/scheduled_messages/new');

        $this->assertDatabaseMissing('scheduled_messages', [
            'body' => $message->body,
            'send_at' => $message->send_at,
        ]);
    }

    /**
     * Test admin can edit a sheduled message.
     *
     * @return void
     */
    public function testAdminCanEditScheduledMessage()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $message = factory(ScheduledMessage::class)->create();
        $newBody = 'New message body!';

        $request = $this
            ->actingAs($user)
            ->put('/admin/scheduled_messages/' . $message->id, [
                'body' => $newBody,
                'send_at' => $message->send_at,
            ]);

        $request->assertRedirect('/admin/scheduled_messages');

        $this->assertDatabaseHas('scheduled_messages', [
            'id' => $message->id,
            'body' => $newBody,
            'send_at' => $message->send_at,
        ]);
    }

    /**
     * Test admin can delete a sheduled message.
     *
     * @return void
     */
    public function testAdminCanDeleteScheduledMessage()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $message = factory(ScheduledMessage::class)->create();
        $messageAttrCheck = [
            'id' => $message->id,
            'body' => $message->body,
            // We don't check send at because the DB record includes seconds
        ];

        $this->assertDatabaseHas('scheduled_messages', $messageAttrCheck);

        $request = $this
            ->actingAs($user)
            ->get('/admin/scheduled_messages/' . $message->id . '/delete');

        $request->assertRedirect('/admin/scheduled_messages');
        $this->assertDatabaseMissing('scheduled_messages', $messageAttrCheck);
    }

    /**
     * Test admin can't edit or delete a sheduled message that has been sent.
     *
     * @return void
     */
    public function testCantChangeAlreadySentScheduledMessage()
    {
        $user = factory(User::class)->create([ 'admin' => true ]);
        $message = factory(ScheduledMessage::class)->create([
            'sent' => true,
            'send_at' => Carbon::create()->subMinutes(1)->toDateTimeString(),
        ]);

        $messageAttrCheck = [
            'id' => $message->id,
            'body' => $message->body,
        ];

        $this->assertDatabaseHas('scheduled_messages', $messageAttrCheck);

        $request = $this
            ->actingAs($user)
            ->get('/admin/scheduled_messages/' . $message->id . '/delete');

        $request->assertRedirect('/admin/scheduled_messages');
        $request->assertSessionHasErrors('cant_change_sent_message');
        $this->assertDatabaseHas('scheduled_messages', $messageAttrCheck);

        $request = $this
            ->actingAs($user)
            ->put('/admin/scheduled_messages/' . $message->id, [
                'body' => 'sup',
            ]);

        $request->assertRedirect('/admin/scheduled_messages');
        $request->assertSessionHasErrors('cant_change_sent_message');
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
        $request = $this
            ->actingAs($user)
            ->get('/admin/scheduled_messages/' . $scheduled_message->id . '/messages');

        // expect to see each of the messages sent
        foreach ($messages as $message) {
            $request->assertSee($message->body);
            $request->assertSee($message->to);
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
