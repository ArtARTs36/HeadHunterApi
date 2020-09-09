<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Support\ParamsUrl;
use PHPUnit\Framework\TestCase;

/**
 * Class ParamsUrlTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class ParamsUrlTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Support\ParamsUrl
     */
    public function testCreate()
    {
        $url = ParamsUrl::convert([
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
