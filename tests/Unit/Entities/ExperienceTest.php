<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Entities\Experience;
use PHPUnit\Framework\TestCase;

/**
 * Class ExperienceTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class ExperienceTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Experience
     */
    public function test(): void
    {
        $data = [
            'id' => 'between1And3',
            'name' => 'От 1 года до 3 лет',
        ];

        $experience = new Experience($data);

        self::assertEquals($data, $experience->getRawData());
        self::assertEquals('От 1 года до 3 лет', $experience->getName());
        self::assertEquals('between1And3', $experience->getKey());
    }
}
