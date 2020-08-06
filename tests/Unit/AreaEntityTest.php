<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Entities\Area;
use PHPUnit\Framework\TestCase;

/**
 * Class AreaTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
class AreaEntityTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Area
     */
    public function test()
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
