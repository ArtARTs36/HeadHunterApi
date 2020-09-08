<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Entities\Specialization;
use ArtARTs36\HeadHunterApi\Tests\TestCase;

/**
 * Class SpecializationTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class SpecializationTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Specialization
     */
    public function testCreateInstance(): void
    {
        $data = [
            'id' => $id = 1,
            'name' => $name = 'IT',
            'profarea_name' => $prof = 'Development',
        ];

        $specialization = new Specialization($data);

        self::assertEquals($data, $specialization->getRawData());
        self::assertEquals($id, $specialization->getId());
        self::assertEquals($name, $specialization->getName());
        self::assertEquals($prof, $specialization->getProfName());
    }
}
