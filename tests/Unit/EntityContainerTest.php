<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Entities\Area;
use ArtARTs36\HeadHunterApi\Support\EntityContainer;
use ArtARTs36\HeadHunterApi\Tests\TestCase;

/**
 * Class EntityContainerTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class EntityContainerTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Support\EntityContainer::get
     * @covers \ArtARTs36\HeadHunterApi\Support\EntityContainer::set
     */
    public function testGet()
    {
        $type = Area::class;
        $id = 1;

        self::assertNull(EntityContainer::get($type, $id));

        //

        $type = Area::class;
        $id = 1;

        $area = $this->createArea($id);

        EntityContainer::set($type, $id, $area);

        self::assertNotNull($response = EntityContainer::get($type, $id));
        self::assertInstanceOf(Area::class, $response);
        self::assertEquals($area, $response);
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Support\EntityContainer::remember
     */
    public function testRemember()
    {
        $type = Area::class;
        $id = 1;
        $area = $this->createArea($id);

        $response = EntityContainer::remember($type, $id, function () use ($area) {
            return $area;
        });

        self::assertInstanceOf($type, $response);
        self::assertEquals($area, $response);
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Support\EntityContainer::reset
     * @covers \ArtARTs36\HeadHunterApi\Support\EntityContainer::count
     */
    public function testResetAndCount(): void
    {
        EntityContainer::reset();

        self::assertEquals(0, EntityContainer::count());

        //

        EntityContainer::set(Area::class, 2, $this->createArea(2));

        self::assertEquals(1, EntityContainer::count());

        //

        EntityContainer::reset();

        self::assertEquals(0, EntityContainer::count());
    }

    /**
     * @param int $id
     * @return Area
     */
    private function createArea(int $id): Area
    {
        return new Area([
            'id' => $id,
            'name' => 'name',
        ]);
    }
}
