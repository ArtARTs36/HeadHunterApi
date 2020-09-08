<?php

namespace ArtARTs36\HeadHunterApi\Support\Entity;

trait WithName
{
    private $name;

    public function getName(): string
    {
        return $this->name;
    }

    protected function setNameOfRawData(array $rawData, string $key = 'name'): self
    {
        $this->name = $rawData[$key] ?? '';

        return $this;
    }
}
