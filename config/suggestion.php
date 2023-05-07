<?php

return [
    'environment' => env('SUGGESTION_ENVIRONMENT', 'qa'),
    'url' => [
        'qa' => env('SUGGESTION_URL', 'https://jx210jm18i.execute-api.us-east-1.amazonaws.com/qas'),
        'production' => env('SUGGESTION_URL', 'https://21e58lr7ua.execute-api.us-east-1.amazonaws.com/prd'),
    ],
    'api_key' => env('SUGGESTION_API_KEY', '95fhfp7RFs1b0qrD0OHhUw9zs2lNUYf9Nxvm9XT6'),
];