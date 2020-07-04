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
        $validated = $request->validate([
            'address' => 'required|string'
        ]);

        $client = new Client();

        try {
            $response = $client->request('GET', $this->apiEndpoint, [
                'query' => [
                    'address' => $validated['address'],
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
}
