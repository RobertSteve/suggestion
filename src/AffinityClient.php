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

        $uuid = $result['uuid'];

        $results = collect($result['results']);

        return collect($workOfferIds)->map(function($workOfferId) use ($uuid, $results) {
            return [
                'uuid' => $uuid,
                'data' => [
                    'work_offer_id' => $workOfferId,
                    'suggestions' => $results
                        ->where('id_offer', $workOfferId)
                        ->map(function ($suggestion) {
                            return [
                                'match_user_id' => $suggestion['match_user_id'],
                                'affinity' => $suggestion['affinity'],
                                'rank' => $suggestion['rank'],
                            ];
                        }),
                ],
            ];
        });

    }

}