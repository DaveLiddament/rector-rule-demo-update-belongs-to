<?php

namespace App\tools\Rector\Tests\FixModelMappingsRector;

use Iterator;
use PHPUnit\Framework\Attributes\DataProvider;
use Rector\Testing\PHPUnit\AbstractRectorTestCase;

class FixModelMappingsRectorTest extends AbstractRectorTestCase
{

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config.php';
    }

    public static function provideData(): Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/Fixture');
    }

    #[DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }
}