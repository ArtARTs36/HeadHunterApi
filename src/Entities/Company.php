<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithId;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRawData;
use ArtARTs36\HeadHunterApi\Support\Entity\WithWebUrl;

class Company implements Entity
{
    use WithRawData;
    use WithId;
    use WithName;
    use WithWebUrl;

    private $vacanciesUrl;

    private $openVacancies;

    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
        $this->id = $rawData['id'];
        $this->name = $rawData['name'];
        $this->webUrl = $rawData['alternate_url'];
        $this->vacanciesUrl = $rawData['vacancies_url'] ?? null;
        $this->openVacancies = $rawData['open_vacancies'] ?? null;
    }

    public function getOpenVacancies(): ?int
    {
        return $this->openVacancies;
    }

    public function getVacanciesUrl(): ?string
    {
        return $this->vacanciesUrl;
    }
}
