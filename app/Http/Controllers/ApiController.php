<?php

namespace App\Http\Controllers;

use App\Services\Sms\Contracts\Sms;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getMessageCount(Request $request, Sms $sms)
    {
        if ($request->missing('message')) {
            return abort(400, 'Bad Request: Missing "message" parameter');
        }

        return (array) $sms->getMessageCount($request->message);
    }
}
