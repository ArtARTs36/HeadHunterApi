<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit\Entities\Support;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Entities\Area;
use ArtARTs36\HeadHunterApi\Support\Entity\WithBooleans;
use ArtARTs36\HeadHunterApi\Tests\TestCase;
use ArtARTs36\HeadHunterApi\Tests\Traits\GetPropertyViaReflection;

final class WithBooleansTest extends TestCase
{
    use GetPropertyViaReflection;

    public function testPrepareBoolean(): void
    {
        $data = [
            'has_test' => true,
        ];

        $entity = $this->createClass($data);

        self::assertTrue($this->getPropertyViaReflection($entity, 'hasTest'));

        //

        $entity = $this->createClass([
            'has_test' => false,
        ]);

        self::assertFalse($this->getPropertyViaReflection($entity, 'hasTest'));

        //

        //

        $entity = $this->createClass([]);

        self::assertFalse($this->getPropertyViaReflection($entity, 'hasTest'));

        //
    }

    private function createClass(array $data): Entity
    {
        return new class($data) implements Entity {
            use WithBooleans;

            private $rawData;

            private $hasTest;

            public function __construct(array $rawData)
            {
                $this->rawData = $rawData;

                $this->hasTest = $this->prepareBoolean('has_test');
            }

            public function getRawData(): array
            {
                return $this->rawData;
            }
        };
    }
}
