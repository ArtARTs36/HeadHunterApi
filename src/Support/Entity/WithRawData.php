<?php

namespace ArtARTs36\HeadHunterApi\Support\Entity;

trait WithRawData
{
    private $rawData;

    /**
     * @inheritDoc
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }
}
