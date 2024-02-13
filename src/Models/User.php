<?php

declare(strict_types=1);

namespace App\Models;

use App\Framework\HasMany;
use App\Framework\Model;

final class User extends Model
{
    public function cars(): HasMany
    {
        return $this->hasMany(Car::class);
    }
}