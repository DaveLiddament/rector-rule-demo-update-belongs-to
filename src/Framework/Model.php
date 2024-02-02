<?php

declare(strict_types=1);

namespace App\Framework;

abstract class Model
{
    public function belongsTo(string $model): BelongsTo
    {
        return new BelongsTo($model);
    }

    public function hasMany(string $model): HasMany
    {
        return new HasMany($model);
    }
}