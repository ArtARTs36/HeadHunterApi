<?php

namespace ArtARTs36\HeadHunterApi\Tests\Traits;

trait GetPropertyViaReflection
{
    public function getPropertyViaReflection($object, string $property)
    {
        $reflector = new \ReflectionObject($object);

        $property = $reflector->getProperty($property);

        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
