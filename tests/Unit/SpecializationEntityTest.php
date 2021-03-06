<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Entities\Specialization;
use PHPUnit\Framework\TestCase;

/**
 * Class SpecializationEntityTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class SpecializationEntityTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Specialization
     */
    public function test(): void
    {
        $rawData = [
            'id' => rand(1, 99),
            'name' => 'Test Specialization',
            'profarea_name' => 'IT',
        ];

        $entity = new Specialization($rawData);

        self::assertEquals($rawData, $entity->getRawData());
        self::assertEquals($rawData['id'], $entity->getId());
        self::assertEquals($rawData['name'], $entity->getName());
        self::assertEquals($rawData['profarea_name'], $entity->getProfName());
    }
}
