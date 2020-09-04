<?php

namespace App\Http\Controllers;

use App\Message;
use App\Subscriber;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.index', [
            'subscriberCount' => Subscriber::all()->count(),
            'subscribersThisWeek' => Subscriber::newThisWeek()->count(),
            'subscribersEN' => Subscriber::all()->where('locale', 'en')->count(),
            'subscribersES' => Subscriber::all()->where('locale', 'es')->count(),
            'pledgeCount' => Subscriber::where('pledged', true)->count(),
        ]);
    }
}
