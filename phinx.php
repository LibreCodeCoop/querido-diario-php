<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/config/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/config/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'development' => [
            'adapter' => getenv('DB_ADAPTER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
