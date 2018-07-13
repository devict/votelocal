<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use App\Services\Sms\Contracts\Sms;
use Illuminate\Support\Facades\App;

class SmsController extends Controller
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
     * Handle incoming SMS messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function receiveSms(Request $request, Sms $sms)
    {
        $message = $sms->messageFromRequest($request);

        // Check if number is already a subscriber
        $subscriber = Subscriber::where('number', $message->from)->first();

        if ($subscriber && $subscriber->subscribed) {
            // Already a subscriber
            App::setLocale($subscriber->locale);

            if ($message->hasTrigger('unsubscribe')) {
                $subscriber->unsubscribe();

                return $sms->response($subscriber->number, __('sms.unsubscribed'));
            }
        }

        // Not currently subscribed
        if ($message->hasTrigger('subscribe')) {
            if (! $subscriber) {
                $subscriber = Subscriber::create(['number' => $message->from]);
            }
            $subscriber->subscribe();

            return $sms->response($subscriber->number, __('sms.subscribed'));
        }

        return response(200);
    }
}
