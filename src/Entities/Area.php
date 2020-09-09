<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithId;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;

/**
 * Class Area
 * @package ArtARTs36\HeadHunterApi\Entities
 */
class Area implements Entity
{
    use WithRawData;
    use WithId;
    use WithName;

    /** @var string|null */
    private $url;

    /**
     * Area constructor.
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;

        $this->id = (int) $rawData['id'];
        $this->setNameOfRawData($rawData);
        $this->url = !empty($rawData['url']) ? (string) $rawData['url'] : null;
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }
}
