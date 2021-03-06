<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit\Entities;

use ArtARTs36\HeadHunterApi\Entities\Area;
use PHPUnit\Framework\TestCase;

/**
 * Class AreaTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class AreaTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Area
     */
    public function testCreateInstance(): void
    {
        $rawData = [
            'id' => rand(1, 99),
            'name' => 'Test Company',
        ];

        $area = new Area($rawData);

        self::assertEquals($rawData, $area->getRawData());
        self::assertEquals($rawData['id'], $area->getId());
        self::assertEquals($rawData['name'], $area->getName());
        self::assertNull($area->getUrl());

        //

        $rawData['url'] = 'http://site.ru';

        $area = new Area($rawData);

        self::assertEquals($rawData['url'], $area->getUrl());
    }
}
