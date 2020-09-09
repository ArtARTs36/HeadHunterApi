<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;

class Schedule implements Entity
{
    use WithRawData;
    use WithName;

    private $key;

    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
        $this->init($rawData);
    }

    protected function init(array $rawData): void
    {
        $this->key = $rawData['id'] ?? '';
        $this->setNameOfRawData($rawData);
    }

    public function getKey(): string
    {
        return $this->key;
    }
}
