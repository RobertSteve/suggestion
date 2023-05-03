<?php

namespace Affinity;

use GuzzleHttp\Client;

class AffinityClient
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('affinity.url.' . config('affinity.environment')),
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => config('affinity.api_key')
            ],
        ]);
    }

    public function get(int $trsId, array $workOfferIds)
    {

        $workOfferIdString = implode(',', $workOfferIds);

        $response = $this->client->post('', [
            'json' => [
                'work_offer_ids' => $workOfferIdString,
                'trs_id' => $trsId,
            ]
        ]);

        $result = json_decode($response->getBody(), true);

        return [
            'uuid' => $result['uuid'],
            'data' => collect($result['results'])
                ->groupBy('id_offer'),
        ];

    }

}