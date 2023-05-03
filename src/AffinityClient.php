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

    public function get($trsId, $workOfferId)
    {
        $url = config('affinity.url.' . config('affinity.environment'));
        $response = $this->client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => config('affinity.api_key')
            ],
            'json' => [
                'work_offer_ids' => $workOfferId,
                'trs_id' => $trsId,
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

}