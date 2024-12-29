<?php
return [
    'allowed_origins' => ['*'],

    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Allow CORS on API paths

    'allowed_methods' => ['*'], // Allow all HTTP methods

    'allowed_origins' => ['http://localhost:8080'], // Allow your frontend origin
    // Use '*' for all origins, but it's less secure in production

    'allowed_origins_patterns' => [], // Optional

    'allowed_headers' => ['*'], // Allow all headers

    'exposed_headers' => [], // Optional

    'max_age' => 0, // Optional

    'supports_credentials' => false, // Set true if sending cookies
];

