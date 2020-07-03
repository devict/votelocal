<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class VCardController extends Controller
{
    public function index()
    {
        return response()->view('vcard')
            ->header('Content-Type', 'text/vcard; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename='.Str::slug(config('app.name')).'.vcf;');
    }
}
