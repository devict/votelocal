<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;

class AdminController extends Controller
{
    function index (Request $request) {
        return view('admin.index');
    }
    
    function subscribers () {
        $subscribers = Subscriber::orderBy('updated_at', 'desc')->get();
        return view('admin.subscribers', ['subscribers' => $subscribers]);
    }
}
