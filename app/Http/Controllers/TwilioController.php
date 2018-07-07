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

        $message = Message::create([
            'subscriber_number' => $fromNumber,
            'to'                => $toNumber,
            'from'              => $fromNumber,
            'body'              => $incomingMessage,
            'incoming'          => true,
            'twilio_sid'        => $sid,
        ]);

        // Check if number is already a subscriber
        $subscriber               = Subscriber::where('number', $fromNumber)->first();

        // TODO: Is there a better place for this logic?

        if ($subscriber && $subscriber->subscribed) {
            // Already a subscriber
            App::setLocale($subscriber->locale);

            if ($message->hasTrigger('unsubscribe')) {
                $subscriber->unsubscribe();

                return $this->messageResponse(
                    __('twilio.unsubscribed'),
                    $subscriber,
                    $toNumber,
                    $sid
                );
            }
        }

        // Not currently subscribed
        if ($message->hasTrigger('subscribe')) {
            if (! $subscriber) {
                $subscriber = Subscriber::create(['number' => $fromNumber]);
            }
            $subscriber->subscribe();

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
            'subscriber_number' => $subscriber->number,
            'to'                => $subscriber->number,
            'from'              => $from,
            'body'              => $message,
            'incoming'          => false,
            'twilio_sid'        => $sid,
        ]);

        $response = new Twiml();
        $response->message($message);

        return response($response, 200)->header('content-type', 'text/xml');
    }
}
