<?php

namespace App\Http\Controllers;

class VCardController extends Controller
{
    public function index()
    {
        return response()->view('vcard')
            ->header('Content-Type', 'text/vcard; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename='.str_slug(config('app.name')).'.vcf;');
    }
}
