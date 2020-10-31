<?php

namespace App\Services\Sms;

use App\Message;
use Illuminate\Http\Request;
use Instasent\SMSCounter\SMSCounter;

class FakeAdapter implements Contracts\Sms
{
    public $sent;

    public $responded;

    public $number;

    public function __construct()
    {
        $this->sent = collect();
        $this->responded = collect();
        $this->number = config('services.twilio.number');
    }

    public function send($number, $body, $options = [])
    {
        $this->sent->push([
            'to' => $number,
            'from' => $this->number,
            'body' => $body,
        ]);

        return $this->store(array_merge([
            'subscriber_number' => $number,
            'from' => $this->number,
            'to' => $number,
            'body' => $body,
            'incoming' => false,
            'twilio_sid' => $this->sent->count(),
        ], $options));
    }

    public function messageFromRequest(Request $request): Message
    {
        $to = $request->input('To');

        return $this->store([
            'subscriber_number' => $request->input('From'),
            'to' => $to,
            'from' => $request->input('From'),
            'body' => $request->input('Body'),
            'twilio_sid' => $request->input('MessageSid'),
            'incoming' => $this->number === $to,
        ]);
    }

    public function response($number, $body)
    {
        $this->store([
            'subscriber_number' => $number,
            'to' => $number,
            'from' => $this->number,
            'body' => $body,
            'incoming' => false,
        ]);

        $this->responded->push([
            'to' => $number,
            'from' => $this->number,
            'body' => $body,
        ]);

        return response($this->responded->last(), 200)->header('content-type', 'text/xml');
    }

    public function getMessageCount(string $message): object
    {
        $smsCounter = new SMSCounter();

        return $smsCounter->count($message);
    }

    protected function store($data)
    {
        return Message::create($data);
    }
}
