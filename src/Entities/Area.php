<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithId;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;

class Area implements Entity
{
    use WithRawData;
    use WithId;
    use WithName;

    private $url;

    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;

        $this->id = $rawData['id'];
        $this->name = $rawData['name'];
        $this->url = $rawData['url'] ?? null;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
