<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index (Request $request) {
        return view('admin.index');
    }
}
