<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Support\ParamsUrl;
use PHPUnit\Framework\TestCase;

class ParamsUrlTest extends TestCase
{
    public function testCreate(): void
    {
        $url = ParamsUrl::create([
            [
                'employeer_id' => 1,
            ],
            [
                'employeer_id' => 2,
            ],
        ]);

        self::assertEquals('employeer_id=1&employeer_id=2', $url);
    }
}
