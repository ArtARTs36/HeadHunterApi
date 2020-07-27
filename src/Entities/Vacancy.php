<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithWebUrl;
use ArtARTs36\HeadHunterApi\Support\EntityContainer;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;

/**
 * Class Vacancy
 * @package ArtARTs36\HeadHunterApi\Entities
 */
class Vacancy implements Entity
{
    use WithRawData;
    use WithName;
    use WithWebUrl;

    /** @var Area */
    private $area;

    /** @var string */
    private $publishedAt;

    /** @var mixed */
    private $salary;

    /** @var array|null */
    private $specializations;

    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;

        $this->name = $rawData['name'];
        $this->area = EntityContainer::remember(Area::class, $rawData['area']['id'], function () use ($rawData) {
            return new Area($rawData);
        });
        $this->publishedAt = $rawData['published_at'];
        $this->webUrl = $rawData['alternate_url'];
        $this->salary = $rawData['salary'];

        if (!empty($rawData['specializations'])) {
            $this->specializations = array_map(function (array $item) {
                return EntityContainer::remember(Specialization::class, $item['id'], function () use ($item) {
                    return new Specialization($item);
                });
            }, $rawData['specializations']);
        }
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @return string
     */
    public function getPublishedAt(): string
    {
        return $this->publishedAt;
    }

    /**
     * @return Area
     */
    public function getArea(): Area
    {
        return $this->area;
    }

    public function getSpecializations(): ?array
    {
        return $this->specializations;
    }
}
