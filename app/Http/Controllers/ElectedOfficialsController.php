<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ElectedOfficialsController extends Controller
{
    private $apiEndpoint;
    private $apiKey;

    public function __construct()
    {
        $this->apiEndpoint = 'https://www.googleapis.com/civicinfo/v2/representatives';
        $this->apiKey = config('services.googleCivicApi.key');
    }

    public function index()
    {
        return view('elected-officials');
    }

    public function lookup(Request $request)
    {
        $client = new Client();

        if (is_null($request->address)) {
            return response('Invalid Address', 400);
        }

        $response = $client->request('GET', $this->apiEndpoint, [
            'query' => [
                'address' => $request->address,
                'key' => $this->apiKey
            ]
        ]);

        $data = json_decode($response->getBody()->getContents());

        // dd($data);

        return view('elected-officials', ['data' => $data]);
    }
}
