<?php
return [
    'plugins' => [
        
    ],
    'environments' => [
        'default_environment' => 'development',
        'development' => [
            'driver' => getenv('DB_ADAPTER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
        ]
    ],
];