<?php

namespace App\Services\Sms;

use App\Message;
use Twilio\Twiml;
use Twilio\Rest\Client;
use Illuminate\Http\Request;

class TwilioAdapter implements Contracts\Sms
{
    protected $client;

    public $number;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $this->number = config('services.twilio.number');
    }

    public function send($number, $body, $options = [])
    {
        $message = $this->client->messages->create($number, [
            'from' => $this->number,
            'body' => $body,
        ]);

        return $this->store(array_merge([
            'subscriber_number' => $number,
            'from'              => $this->number,
            'to'                => $number,
            'body'              => $body,
            'incoming'          => false,
            'twilio_sid'        => $message->sid,
        ], $options));
    }

    public function messageFromRequest(Request $request) : Message
    {
        $to = $request->input('To');

        return $this->store([
            'subscriber_number' => $request->input('From'),
            'to'                => $to,
            'from'              => $request->input('From'),
            'body'              => $request->input('Body'),
            'twilio_sid'        => $request->input('MessageSid'),
            'incoming'          => $this->number === $to,
        ]);
    }

    public function response($number, $body)
    {
        $this->store([
            'subscriber_number' => $number,
            'to'                => $number,
            'from'              => $this->number,
            'body'              => $body,
            'incoming'          => false
        ]);

        $response = new Twiml();
        $response->message($body);

        return response($response, 200)->header('content-type', 'text/xml');
    }

    protected function store($data)
    {
        return Message::create($data);
    }
}
