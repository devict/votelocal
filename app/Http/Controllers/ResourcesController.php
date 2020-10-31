<?php

namespace App\Http\Controllers;

class ResourcesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('resources');
    }
}
