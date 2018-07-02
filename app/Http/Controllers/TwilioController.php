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
        $fromNumber = $request->input('From');

        Message::create([
            'to' => $request->input('To'),
            'from' => $fromNumber,
            'body' => $incomingMessage,
            'incoming' => true,
            'twilio_sid' => $request->input('MessageSid'),
        ]);

        // check if user is already a subscriber
        $subscriber = Subscriber::where('number', $fromNumber)->first();
        $processedIncomingMessage = strtolower(trim($incomingMessage));
        $returnMessage = null;

        // TODO: Is there a better place for this logic?

        if ($subscriber && $subscriber->subscribed) {
            // Already a subscriber
            App::setLocale($subscriber->locale);

            $unsubTriggers = ['unsubscribe', 'stop'];

            if (in_array($processedIncomingMessage, $unsubTriggers)) {
                $subscriber->subscribed = false;
                $subscriber->save();
                $returnMessage = __('twilio.unsubscribed');
            }
        } else {
            // Not currently subscribed
            $subscribeTriggers = ['subscribe', 'start'];
            if (in_array(strtolower($processedIncomingMessage), $subscribeTriggers)) {
                if (!$subscriber) {
                    Subscriber::create([ 'number' => $fromNumber ]);
                } else {
                    $subscriber->subscribed = true;
                    $subscriber->save();
                }
                $returnMessage = __('twilio.subscribed');
            }
        }

        if ($returnMessage != null) {
            Message::create([
                'to' => $fromNumber,
                'from' => $request->input('To'),
                'body' => $returnMessage,
                'incoming' => false,
                'twilio_sid' => $request->input('MessageSid'),
            ]);

            $response = new Twiml();
            $response->message($returnMessage);

            return response($response, 200)->header('content-type', 'text/xml');
        }

        return response(200);
    }
}
