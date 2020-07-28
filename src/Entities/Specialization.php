<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithId;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;

/**
 * Class Specialization
 * @package ArtARTs36\HeadHunterApi\Entities
 */
class Specialization implements Entity
{
    use WithRawData;
    use WithName;
    use WithId;

    /** @var string */
    private $profName;

    /**
     * Specialization constructor.
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
        $this->name = (string) $rawData['name'];
        $this->id = (int) $rawData['id'];
        $this->profName = (string) $rawData['profarea_name'];
    }

    /**
     * @return string
     */
    public function getProfName(): string
    {
        return $this->profName;
    }
}
