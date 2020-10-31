<?php

namespace Tests\Feature;

use App\Message;
use App\Subscriber;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use RefreshDatabase;

    public function testUnauthorizedUserCannotViewSubscribers()
    {
        $this->assertAdminOnly('get', route('subscribers.admin.index'));
    }

    public function testAdminCanViewSubscribers()
    {
        $this->be(User::factory()->asAdmin()->create())
            ->get(route('subscribers.admin.index'))
            ->assertStatus(200);
    }

    public function testAdminCanViewSubscriberMessages()
    {
        $message = Message::factory()->create();
        $this->be(User::factory()->asAdmin()->create())
            ->get(route('subscribers.admin.edit', $message->subscriber))
            ->assertSee($message->subscriber->number);
    }

    public function testUnauthenticatedUserCannotCreateSubscriber()
    {
        $this->assertAdminOnly('post', route('subscribers.admin.create'));
    }

    public function testAdminCanCreateSubscriber()
    {
        $subscriber = Subscriber::factory()->make();
        $this->be(User::factory()->asAdmin()->create())
            ->withoutExceptionHandling()
            ->post(route('subscribers.admin.create'), $subscriber->toArray())
            ->assertRedirect(route('subscribers.admin.index'));

        $this->assertDatabaseHas('subscribers', [
            'number' => $subscriber->number,
        ]);
    }

    public function testUnauthenticatedUserCannotUpdateSubscriber()
    {
        $this->assertAdminOnly(
            'put',
            route('subscribers.admin.update', Subscriber::factory()->create())
        );
    }

    public function testAdminCanUpdateSubscriber()
    {
        $subscriber = Subscriber::factory()->create(['subscribed' => true]);
        $this->be(User::factory()->asAdmin()->create())
            ->withoutExceptionHandling()
            ->put(route('subscribers.admin.update', $subscriber), [])
            ->assertRedirect(route('subscribers.admin.index'));

        $this->assertDatabaseHas('subscribers', ['subscribed' => false]);
    }

    public function testSubscribeFromSite()
    {
        $this->get(route('home'))->assertOk();
    }
}
