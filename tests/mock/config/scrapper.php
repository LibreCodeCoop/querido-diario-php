<?php

return [
    'plugins' => [
        QueridoDiario\Tests\mock\spiders\CollectorStub::class
    ],
    'environments' => [
        'default_environment' => 'development',
        'development' => [
            'driver' => 'pdo_sqlite',
            'memory' => true,
        ]
    ],
];