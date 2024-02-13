<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Utils\Rector\Rector\FixModelMappingsRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(FixModelMappingsRector::class);
};
