<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function testUnauthorizedUserCannotViewSubscribers()
    {
        $this->assertAdminOnly('get', route('subscribers.admin.index'));
    }

    public function testAdminCanViewSubscribers()
    {
        $this->signIn(['admin' => 1])
            ->get(route('subscribers.admin.index'))
            ->assertStatus(200);
    }

    public function testAdminCanViewSubscriberMessages()
    {
        $message = create('App\Message');
        $this->signIn(['admin' => 1])
            ->get(route('subscribers.admin.messages', $message->subscriber))
            ->assertSee($message->subscriber->number);
    }

    public function testUnauthenticatedUserCannotCreateSubscriber()
    {
        $this->assertAdminOnly('post', route('subscribers.admin.create'));
    }

    public function testAdminCanCreateSubscriber()
    {
        $subscriber = make('App\Subscriber');
        $r          = $this->signIn(['admin' => 1])
            ->withoutExceptionHandling()
            ->post(route('subscribers.admin.create'), $subscriber->toArray())
            ->assertRedirect(route('subscribers.admin.index'));
        $this->assertDatabaseHas('subscribers', [
            'number' => $subscriber->number
        ]);
    }

    public function testUnauthenticatedUserCannotUpdateSubscriber()
    {
        $this->assertAdminOnly(
            'put',
            route('subscribers.admin.update', create('App\Subscriber'))
        );
    }

    public function testAdminCanUpdateSubscriber()
    {
        $newAttrs   = ['number' => '1231231234'];
        $subscriber = create('App\Subscriber');
        $this->signIn(['admin' => 1])
            ->withoutExceptionHandling()
            ->put(route('subscribers.admin.update', $subscriber), $newAttrs)
            ->assertRedirect(route('subscribers.admin.index'));

        $this->assertDatabaseHas('subscribers', $newAttrs);
    }
}
