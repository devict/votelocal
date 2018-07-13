<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Subscriber;

class TwilioTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests that a new number texting "subscribe" registers the user
     * and returns the expected response.
     *
     * @return void
     */
    public function testNewSubscriber()
    {
        $twilioSms = $this->createTwilioIncomingSms([
            'Body' => 'SubsCribe',
        ]);

        $response = $this->json('POST', '/sms/receive', $twilioSms);

        $this->assertDatabaseHas('subscribers', [
            'number' => $twilioSms['From'],
            'subscribed' => true,
        ]);

        $response->assertStatus(200);
        $response->assertSeeText(__('sms.subscribed'));
    }

    /**
     * Test that a message from a new number that isn't a subscribe keyword
     * does not create a new subscriber.
     * 
     * @return void
     */
    public function testNoSubscribeMessage()
    {
        $twilioSms = $this->createTwilioIncomingSms([]);
        $response = $this->json('POST', '/sms/receive', $twilioSms);

        $this->assertDatabaseMissing('subscribers', [
            'number' => $twilioSms['From'],
        ]);

        $response->assertStatus(200);
        $response->assertDontSeeText(__('twilio.subscribed'));
    }

    /**
     * Test receiving unsubscribe message from existing subscriber will mark
     * them as unsubscribed in the database.
     * 
     * @return void
     */
    public function testUnsubscribeActiveSusbcriber()
    {
        $subscriber = factory(Subscriber::class)->create();
        $twilioSms = $this->createTwilioIncomingSms([
            'From' => $subscriber->number,
            'Body' => 'UnSubScribe',
        ]);

        $response = $this->json('POST', '/sms/receive', $twilioSms);

        $this->assertDatabaseHas('subscribers', [
            'number' => $subscriber->number,
            'id' => $subscriber->id,
            'subscribed' => false,
        ]);

        $response->assertStatus(200);
        $response->assertSeeText(__('sms.unsubscribed'));
    }

    /**
     * Util!
     * -------------------
     */

     private function createTwilioIncomingSms($attrs)
     {
         $defaults = [
             'MessageSid' => str_random(32),
             'From' => '+15555555555',
             'To' => '+12222222222',
             'Body' => 'Test message',
         ];
         return array_merge($defaults, $attrs);
     }
}
