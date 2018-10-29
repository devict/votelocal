<?php

namespace App\Http\Controllers;

use App\ScheduledMessage;

class ArchiveController extends Controller
{
    public function index()
    {
        return view('archive', [
            'messages' => ScheduledMessage::sent()->orderBy('created_at', 'desc')->paginate(),
        ]);
    }
}
