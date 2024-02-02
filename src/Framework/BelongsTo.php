<?php

declare(strict_types=1);

namespace App\Framework;

final class BelongsTo
{
    public function __construct(
        public readonly string $model,
    ) {
    }
}