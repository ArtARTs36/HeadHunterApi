<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;

class Experience implements Entity
{
    use WithName;
    use WithRawData;

    /** @var string */
    private $key;

    public function __construct(array $rawData)
    {
        $this->setNameOfRawData($rawData);

        $this->key = $rawData['id'] ? (string) $rawData['id'] : '';

        $this->rawData = $rawData;
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
