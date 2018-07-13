<?php

namespace App\Services\Sms\Contracts;

use App\Message;
use Illuminate\Http\Request;

interface Sms
{
    public function send($number, $body);

    public function messageFromRequest(Request $request) : Message;

    public function response($number, $body);
}
