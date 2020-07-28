<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Support\Collection;
use PHPUnit\Framework\TestCase;

/**
 * Class CollectionTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
class CollectionTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Support\Collection
     */
    public function test(): void
    {
        $maxCount = 30;
        $maxPage = 5;
        $page = 2;
        $items = range(1, 10);

        $collection = new Collection($items, $maxCount, $maxPage, $page);

        self::assertTrue($collection->offsetExists(1));
        self::assertFalse($collection->offsetExists(11));

        self::assertEquals($items[5], $collection->offsetGet(5));

        self::assertCount(count($items), $collection);
        self::assertCount(count($items), $collection->getIterator());
        self::assertEquals($maxPage, $collection->maxPage());
        self::assertEquals($maxCount, $collection->maxCount());
        self::assertEquals($items, $collection->all());
        self::assertEquals($items[0], $collection->first());
        self::assertEquals($items[9], $collection->last());
        self::assertEquals($page, $collection->page());

        $collection->offsetSet(11, 5);
        self::assertEquals(5, $collection->offsetGet(11));

        $collection->offsetUnset(11);
        self::assertFalse($collection->offsetExists(11));

        $collection->push(9);
        self::assertTrue($collection->offsetExists(12));

        //

        $collection = new Collection($items);

        self::assertEquals(count($items), $collection->maxCount());
        self::assertEquals(0, $collection->maxPage());
        self::assertEquals(0, $collection->page());
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Support\Collection::map
     */
    public function testMap(): void
    {
        $items = [5, 6, 7, 8, 9];

        $collection = new Collection($items);

        $collection->map(function ($item) use ($items) {
            self::assertTrue(in_array($item, $items));
        });
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Support\Collection::filter
     */
    public function testFilter(): void
    {
        $items = [5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];

        $collection = new Collection($items);

        $collection = $collection->filter(function ($item) {
            return $item > 14;
        });

        self::assertEquals([15], $collection->values()->all());
    }
}
