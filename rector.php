<?php

declare(strict_types=1);

use App\Tools\Rector\FixModelMappingsRector;
use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
    ])
    ->withRules([
        FixModelMappingsRector::class,
    ]
);
