<?php

namespace Suggestion;

use GuzzleHttp\Client;

class SuggestionClient
{

    protected $client;

    public function __construct()
    {
       $this->client = new Client([
            'base_uri' => config('suggestion.url.' . config('suggestion.environment')),
            'headers' => [
                'Content-Type' => 'application/json',
                'x-api-key' => config('suggestion.api_key')
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

        return [
            'uuid' => $uuid,
            'data' => collect($workOfferIds)->map(function($workOfferId) use ($results) {
                return [
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
                ];
            }),
        ];

    }

}