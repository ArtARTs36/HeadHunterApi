<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithId;
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
    use WithId;

    /** @var Area */
    private $area;

    /** @var string */
    private $publishedAt;

    /** @var mixed */
    private $salary;

    /** @var array|null */
    private $specializations;

    /** @var string */
    private $description;

    /** @var array|null */
    private $skillsNames;

    /** @var bool */
    private $hasTestTask;

    /** @var Experience|null */
    private $experience;

    /**
     * Vacancy constructor.
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;

        $this->id = (int) $rawData['id'];
        $this->setNameOfRawData($rawData);
        $this->area = EntityContainer::remember(Area::class, $rawData['area']['id'], function () use ($rawData) {
            return new Area($rawData['area']);
        });

        $this->publishedAt = $rawData['published_at'];
        $this->webUrl = (string) $rawData['alternate_url'];
        $this->salary = $rawData['salary'];
        $this->description = !empty($rawData['description']) ? (string) $rawData['description'] : null;

        if (!empty($rawData['specializations'])) {
            $this->specializations = array_map(function (array $item) {
                return EntityContainer::remember(Specialization::class, $item['id'], function () use ($item) {
                    return new Specialization($item);
                });
            }, $rawData['specializations']);
        }

        if (!empty($rawData['key_skills'])) {
            $this->skillsNames = array_map(function (array $item) {
                return $item['name'];
            }, $rawData['key_skills']);
        }

        $this->hasTestTask = $rawData['has_test'] ?? false;

        if (!empty($rawData['experience']) && !empty($rawData['experience']['id'])) {
            $this->experience = EntityContainer::remember(
                Experience::class,
                $rawData['experience']['id'],
                function () use ($rawData) {
                    return new Experience($rawData['experience']);
                }
            );
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

    /**
     * @return array|null
     */
    public function getSpecializations(): ?array
    {
        return $this->specializations;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getPreparedDescription()
    {
        if (empty($this->description)) {
            return null;
        }

        $description = str_replace(
            ['<br />', '<li>', '<p>', '  '],
            ["\n", "\n", "\n", ' '],
            $this->description
        );

        $description = trim($description);

        return strip_tags($description);
    }

    /**
     * @return array|null
     */
    public function getSkillsNames(): ?array
    {
        return $this->skillsNames;
    }

    /**
     * @return bool
     */
    public function hasTestTask(): bool
    {
        return $this->hasTestTask;
    }

    /**
     * @return Experience|null
     */
    public function getExperience(): ?Experience
    {
        return $this->experience;
    }
}
