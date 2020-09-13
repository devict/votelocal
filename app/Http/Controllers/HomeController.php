<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Cache;
use App\Subscriber;

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
                curl_setopt($curl, CURLOPT_USERAGENT, 'VoteLocalBot/1.0');
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_URL, 'https://api.github.com/repos/devict/votelocal/contributors');
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

    public function pledge($referred_by = null)
    {
        return view('pledge', [ 'referred_by' => $referred_by ]);
    }

    public function pledgeProgress()
    {
        /* $pledgeCount = Subscriber::where('pledged', true)->count(); */
        $pledgeCount = 54;
        $pledgeGoal = 2020;
        $pledgePercent = round(($pledgeCount / $pledgeGoal) * 100);

        return view('pledge-progress', [
            'pledgeCount' => $pledgeCount,
            'pledgeGoal' => $pledgeGoal,
            'pledgePercent' => $pledgePercent,
            'subsForLeaderboard' => Subscriber::forLeaderboard(),
        ]);
    }
}
