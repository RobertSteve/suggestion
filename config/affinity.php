<?php

return [
    'environment' => env('AFFINITY_ENVIRONMENT', 'qa'),
    'url' => [
        'qa' => env('AFFINITY_URL', 'https://jx210jm18i.execute-api.us-east-1.amazonaws.com/qas/affinity-ml'),
        'production' => env('AFFINITY_URL', 'https://21e58lr7ua.execute-api.us-east-1.amazonaws.com/prd/affinity-ml'),
    ],
    'api_key' => env('AFFINITY_API_KEY', '95fhfp7RFs1b0qrD0OHhUw9zs2lNUYf9Nxvm9XT6'),
];