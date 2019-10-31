<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contributors = [];
        try {
            $contributors = Cache::remember('contributors', now()->addDay(), function () {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_USERAGENT, 'VoteICTBot/1.0');
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, 'https://api.github.com/repos/devict/voteict/contributors');
                $response = curl_exec($curl);
                curl_close($curl);

                return json_decode($response);
            });
        } catch (Exception $e) {
            // Ignore errors
        }

        return view('home', [
            'contributors' => $contributors,
        ]);
    }
}
