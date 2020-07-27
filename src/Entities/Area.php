<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;

class Area implements Entity
{
    use WithRawData;

    private $id;

    private $name;

    private $url;

    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;

        $this->id = $rawData['id'];
        $this->name = $rawData['name'];
        $this->url = $rawData['url'] ?? null;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
