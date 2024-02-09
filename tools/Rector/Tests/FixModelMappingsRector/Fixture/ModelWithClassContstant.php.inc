<?php

namespace App\Tools\Rector\Tests\FixModelMappingsRector\Fixture;

use App\Framework\BelongsTo;
use App\Framework\Model;
use App\Models\User;

final class Car extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
