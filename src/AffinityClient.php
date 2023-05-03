<?php

namespace Affinity;

use GuzzleHttp\Client;

class AffinityClient
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get()
    {
        $response = $this->client->post(config('affinity.url'), [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => '95fhfp7RFs1b0qrD0OHhUw9zs2lNUYf9Nxvm9XT6'
            ],
            'json' => [
                'work_offer_ids' => '795',
                'trs_id' => '2000000000',
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

}