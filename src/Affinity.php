<?php

namespace Affinity;

use GuzzleHttp\Client;

class Affinity
{

    public function get($token, $workOfferId, $trsId)
    {

        $client = new Client();

        $response = $client->post('https://21e58lr7ua.execute-api.us-east-1.amazonaws.com/prd/affinity-ml', [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => $token
            ],
            'json' => [
                'work_offer_ids' => $workOfferId,
                'trs_id' => $trsId
            ]
        ]);

        return $response->getBody()->getContents();

    }

}