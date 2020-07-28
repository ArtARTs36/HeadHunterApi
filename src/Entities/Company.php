<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithId;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;
use ArtARTs36\HeadHunterApi\Support\Entity\WithWebUrl;

/**
 * Class Company
 * @package ArtARTs36\HeadHunterApi\Entities
 */
class Company implements Entity
{
    use WithRawData;
    use WithId;
    use WithName;
    use WithWebUrl;

    /** @var string|null */
    private $vacanciesUrl;

    /** @var int|null */
    private $openVacanciesCount;

    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
        $this->id = (string) $rawData['id'];
        $this->name = (string) $rawData['name'];
        $this->webUrl = (string) $rawData['alternate_url'];
        $this->vacanciesUrl = !empty($rawData['vacancies_url']) ? (string) $rawData['vacancies_url'] : null;
        $this->openVacanciesCount = !empty($rawData['open_vacancies']) ? (int) $rawData['open_vacancies'] : null;
    }

    /**
     * @return int|null
     */
    public function getOpenVacanciesCount(): ?int
    {
        return $this->openVacanciesCount;
    }

    /**
     * @return string|null
     */
    public function getVacanciesUrl(): ?string
    {
        return $this->vacanciesUrl;
    }
}
