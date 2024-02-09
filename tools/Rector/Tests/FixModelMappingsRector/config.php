<?php

use Rector\Config\RectorConfig;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->rule(\App\Tools\Rector\FixModelMappingsRector::class);
};