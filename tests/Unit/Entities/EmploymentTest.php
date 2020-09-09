<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit\Entities;

use ArtARTs36\HeadHunterApi\Entities\Employment;
use ArtARTs36\HeadHunterApi\Tests\TestCase;

final class EmploymentTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Employment
     */
    public function testCreateInstance(): void
    {
        $employment = new Employment([
            'id' => $key = 'full',
            'name' => $name = 'Полная занятость',
        ]);

        self::assertEquals($key, $employment->getKey());
        self::assertEquals($name, $employment->getName());
    }
}
