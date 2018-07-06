<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Message;
use App\Subscriber;
use Twilio\Twiml;

class TwilioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // TODO: make twilio request verification middleware
    }

    /**
     * Handle incoming SMS messages from Twilio.
     *
     * @return \Illuminate\Http\Response
     */
    public function receiveSms(Request $request)
    {
        $incomingMessage = $request->input('Body');
        $fromNumber      = $request->input('From');
        $toNumber        = $request->input('To');
        $sid             = $request->input('MessageSid');

        // Check if number is already a subscriber
        $subscriber = Subscriber::where('number', $fromNumber)->first();

        $message = Message::create([
            'subscriber_id' => $subscriber->id ?? null,
            'to'            => $toNumber,
            'from'          => $fromNumber,
            'body'          => $incomingMessage,
            'incoming'      => true,
            'twilio_sid'    => $sid,
        ]);

        $processedIncomingMessage = strtolower(trim($incomingMessage));

        // TODO: Is there a better place for this logic?

        if ($subscriber && $subscriber->subscribed) {
            // Already a subscriber
            App::setLocale($subscriber->locale);

            $unsubTriggers = ['unsubscribe', 'stop'];

            if (in_array($processedIncomingMessage, $unsubTriggers)) {
                $subscriber->update(['subscribed' => false]);

                return $this->messageResponse(
                    __('twilio.unsubscribed'),
                    $subscriber,
                    $toNumber,
                    $sid
                );
            }
        }

        // Not currently subscribed
        $subscribeTriggers = ['subscribe', 'start'];
        if (in_array($processedIncomingMessage, $subscribeTriggers)) {
            if (! $subscriber) {
                $subscriber = Subscriber::create(['number' => $fromNumber]);
            }
            $subscriber->update(['subscribed' => true]);

            return $this->messageResponse(
                __('twilio.subscribed'),
                $subscriber,
                $toNumber,
                $sid
            );
        }

        return response(200);
    }

    protected function messageResponse($message, $subscriber, $from, $sid)
    {
        Message::create([
            'subscriber_id' => $subscriber->id,
            'to'            => $subscriber->number,
            'from'          => $from,
            'body'          => $message,
            'incoming'      => false,
            'twilio_sid'    => $sid,
        ]);

        $response = new Twiml();
        $response->message($message);

        return response($response, 200)->header('content-type', 'text/xml');
    }
}
