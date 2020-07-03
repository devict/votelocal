<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElectedOfficialsController extends Controller
{
    public function index()
    {
        return view('elected-officials');
    }
}
