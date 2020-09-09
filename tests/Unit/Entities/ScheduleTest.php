<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit\Entities;

use ArtARTs36\HeadHunterApi\Entities\Schedule;
use ArtARTs36\HeadHunterApi\Tests\TestCase;

final class ScheduleTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Schedule
     */
    public function testCreateInstance(): void
    {
        $schedule = new Schedule([
            'id' => $key = 'fullDay',
            'name' => $name = 'Полный день',
        ]);

        self::assertEquals($key, $schedule->getKey());
        self::assertEquals($name, $schedule->getName());
    }
}
