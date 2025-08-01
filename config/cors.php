<?php

return [

    'paths' => ['*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:5173',
        'http://192.168.100.16:5173',
        'http://127.0.0.1:5500/index.html',
        'https://gatah.alowairdi.com',
        'https://gatah-admin.alowairdi.com',
        'https://mediumspringgreen-dinosaur-305664.hostingersite.com',
    ],

    'allowed_origins_patterns' => [
        '/^http:\/\/localhost:\d+$/',
        '/^http:\/\/192\.168\.100\.20:\d+$/',
    ],

    'allowed_headers' => ['*'],

    'exposed_headers' => ['Authorization', 'X-CSRF-TOKEN'],

    'max_age' => 0,

    'supports_credentials' => true,

];
