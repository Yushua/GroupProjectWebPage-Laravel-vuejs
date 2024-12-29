// config/cors.php

<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing.
    |
    */

    'paths' => ['api/*', '/register', '/login'],  // Define which paths to apply CORS

    'allowed_methods' => ['*'],  // Allow all HTTP methods

    'allowed_origins' => ['*'],  // Allow all origins (you can change '*' to your specific frontend URL like 'http://localhost:8080')

    'allowed_headers' => ['*'],  // Allow all headers

    'exposed_headers' => [],  // Any headers you want to expose, leave empty if not needed

    'max_age' => 0,  // Max time for the preflight request to be cached

    'supports_credentials' => false,  // Set to true if you need cookies or credentials in your CORS requests
];
