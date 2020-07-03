<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        try {
            $response = $client->request('GET', $this->apiEndpoint, [
                'query' => [
                    'address' => $request->address,
                    'key' => $this->apiKey
                ]
            ]);

            $data = json_decode($response->getBody()->getContents());

            return view('elected-officials', ['data' => $data]);
        } catch (ClientException $e) {
            $error = json_decode($e->getResponse()->getBody()->getContents());

            return view('elected-officials', ['error' => $error->error]);
        }
    }

    public function success()
    {
    }

    public function error()
    {
    }
}
