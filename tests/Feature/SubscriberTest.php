<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Message;
use App\Subscriber;

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
        $message = factory(Message::class)->create();
        $this->signIn(['admin' => 1])
            ->get(route('subscribers.admin.edit', $message->subscriber))
            ->assertSee($message->subscriber->number);
    }

    public function testUnauthenticatedUserCannotCreateSubscriber()
    {
        $this->assertAdminOnly('post', route('subscribers.admin.create'));
    }

    public function testAdminCanCreateSubscriber()
    {
        $subscriber = factory(Subscriber::class)->make();
        $this->signIn(['admin' => 1])
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
            route('subscribers.admin.update', factory(Subscriber::class)->create())
        );
    }

    public function testAdminCanUpdateSubscriber()
    {
        $subscriber = factory(Subscriber::class)->create(['subscribed' => true]);
        $this->signIn(['admin' => 1])
            ->withoutExceptionHandling()
            ->put(route('subscribers.admin.update', $subscriber), [])
            ->assertRedirect(route('subscribers.admin.index'));

        $this->assertDatabaseHas('subscribers', ['subscribed' => false]);
    }

    public function testSubscribeFromSite()
    {
        $this->get(route('home'));
    }
}
