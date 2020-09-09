<?php

namespace ArtARTs36\HeadHunterApi\Support\Entity;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\EntityContainer;

trait WithRelations
{
    protected function prepareRelation(string $class, array $rawData, string $idKey = 'id'): Entity
    {
        return EntityContainer::remember($class, $rawData[$idKey], function () use ($rawData, $class) {
            return new $class($rawData);
        });
    }
}
