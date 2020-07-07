<?php

namespace App\Http\Controllers;

use App\Subscriber;
use App\Tag;
use Illuminate\Http\Request;
use App\Services\Sms\Contracts\Sms;

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
            if ($message->hasTrigger('subscribe')) {
                // Check if user is resubscribing in a different locale.
                $locale = $message->getLocaleFromTrigger('subscribe');
                if ($locale != $subscriber->locale) {
                    $subscriber->update([
                        'locale' => $locale,
                    ]);

                    return $sms->response($subscriber->number, __('sms.updateLocale', [], $subscriber->locale));
                }

                // Already subscribed.
                return $sms->response($subscriber->number, __('sms.alreadySubscribed', [], $subscriber->locale));
            }

            if ($message->hasTrigger('unsubscribe')) {
                // Update locale if necessary.
                $locale = $message->getLocaleFromTrigger('unsubscribe');
                if ($locale != $subscriber->locale) {
                    $subscriber->update([
                        'locale' => $locale,
                    ]);
                }

                $subscriber->unsubscribe();
                return $sms->response($subscriber->number, __('sms.unsubscribed', [], $subscriber->locale));
            }

            return response(200);
        }

        // Not currently subscribed
        $locale = $message->getLocaleFromTrigger('subscribe');
        if ($locale) {
            if (!$subscriber) {
                $subscriber = Subscriber::create([
                    'number' => $message->from,
                    'locale' => $locale
                ]);

                $subscriber->tags()->sync(Tag::subscriberDefaults()->get());
            }
            $subscriber->update([
                'subscribed' => true,
                'locale'     => $locale
            ]);

            return $sms->response($subscriber->number, __('sms.subscribed', [], $subscriber->locale));
        }

        return response(200);
    }
}
