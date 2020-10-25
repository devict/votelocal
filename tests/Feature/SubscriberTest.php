<?php

namespace Tests\Feature;

use App\Message;
use App\Subscriber;
use App\Tag;
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
            'number' => $subscriber->number,
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
        $tags = factory(Tag::class, 2)->create();
        $subscriber = factory(Subscriber::class)->create(['subscribed' => true]);
        $this->signIn(['admin' => 1])
            ->withoutExceptionHandling()
            ->put(route('subscribers.admin.update', $subscriber), [
                'tags' => $tags->pluck('id'),
            ])
            ->assertRedirect(route('subscribers.admin.index'));

        $this->assertDatabaseHas('subscribers', ['subscribed' => false]);
        $this->assertEquals($subscriber->fresh()->tags->pluck('id'), $tags->pluck('id'));
    }

    public function testSubscribeFromSite()
    {
        $this->get(route('home'))->assertOk();
    }
}
