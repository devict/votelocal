<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;

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
            'address' => 'required|string',
        ]);

        $client = new Client();

        try {
            $response = $client->request('GET', $this->apiEndpoint, [
                'query' => [
                    'address' => $validated['address'],
                    'key' => $this->apiKey,
                ],
            ]);

            $data = Cache::remember($validated['address'], now()->addHour(), function () use ($response) {
                return json_decode($response->getBody()->getContents());
            });

            return view('elected-officials', ['data' => $data]);
        } catch (ClientException $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents());
            $reasons = collect();

            if (property_exists($response, 'error')) {
                $reasons = collect($response->error->errors)->map(function ($error) {
                    if ($error->reason === 'parseError') {
                        $error->reason = 'Make sure to include your house number, street, city, state, and zip code.';
                    }

                    return $error->reason;
                });
            }

            throw ValidationException::withMessages(['address' => 'We had some trouble reading that address. '.$reasons->implode('. ')]);
        }
    }
}
