<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
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
        Message::create([
            'to' => $request->input('To'),
            'from' => $request->input('From'),
            'body' => $request->input('Body'),
            'twilio_sid' => $request->input('MessageSid'),
        ]);

        $response = new Twiml();
        $response->message('lolnope');
        return response($response, 200)->header('content-type', 'text/xml');
    }
}
