<?php
namespace Utils\Rector\Tests\Rector\FixModelMappingsRector\Fixture;

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
