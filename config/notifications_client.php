
<?php

return [
    'mode' => env('ALLINGO_NOTIF_MODE', 'external'),

    'external' => [
        'base_url' => env('B2B_NOTIF_BASE_URL', 'https://b2b.example.com'),
        'token'    => env('B2B_NOTIF_TOKEN'),
        'timeout'  => (int) env('B2B_NOTIF_TIMEOUT', 5),
    ],

    // NEW: how to resolve the internal dispatcher service from your app container
    'internal' => [
        // a container binding alias OR a fully-qualified class name
        // example: App\Services\Notifications\DispatchService::class
        'service' => env('B2B_INTERNAL_DISPATCHER', null),
        // method to call on that service:
        'method'  => env('B2B_INTERNAL_DISPATCH_METHOD', 'dispatchCode'),
    ],
];