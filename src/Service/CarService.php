<?php

declare(strict_types=1);

namespace App\Service;

class CarService
{
    public function doSomething(): void
    {
        $this->belongsTo('car');
    }

    public function belongsTo(string $name): void
    {
        // Does something
    }
}