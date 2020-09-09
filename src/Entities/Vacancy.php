<?php

namespace ArtARTs36\HeadHunterApi\Entities;

use ArtARTs36\HeadHunterApi\Contracts\Entity;
use ArtARTs36\HeadHunterApi\Support\Entity\WithBooleans;
use ArtARTs36\HeadHunterApi\Support\Entity\WithId;
use ArtARTs36\HeadHunterApi\Support\Entity\WithName;
use ArtARTs36\HeadHunterApi\Support\Entity\WithRelations;
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
    use WithBooleans;
    use WithRelations;

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

    /** @var bool */
    private $isAcceptedKids;

    /** @var bool */
    private $isAcceptedHandicapped;

    /** @var Schedule|null */
    private $schedule;

    /** @var Employment|null */
    private $employment;

    /**
     * Vacancy constructor.
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->init($rawData);
    }

    /**
     * @param array $rawData
     */
    protected function init(array $rawData): void
    {
        $this->rawData = $rawData;

        $this->id = (int) $rawData['id'];
        $this->setNameOfRawData($rawData);

        $this->publishedAt = $rawData['published_at'];
        $this->webUrl = (string) $rawData['alternate_url'];
        $this->salary = $rawData['salary'];
        $this->description = !empty($rawData['description']) ? (string) $rawData['description'] : null;

        if (!empty($rawData['key_skills'])) {
            $this->skillsNames = array_map(function (array $item) {
                return $item['name'];
            }, $rawData['key_skills']);
        }

        $this->hasTestTask = $this->prepareBoolean('has_test');
        $this->isAcceptedKids = $this->prepareBoolean('accept_kids');
        $this->isAcceptedHandicapped = $this->prepareBoolean('accept_handicapped');

        $this->initRelations($rawData);
    }

    protected function initRelations(array $rawData): void
    {
        $this->area = $this->prepareRelation(Area::class, $rawData['area']);

        if (!empty($rawData['specializations'])) {
            $this->specializations = array_map(function (array $item) {
                return $this->prepareRelation(Specialization::class, $item);
            }, $rawData['specializations']);
        }

        if (!empty($rawData['experience']) && !empty($rawData['experience']['id'])) {
            $this->experience = $this->prepareRelation(Experience::class, $rawData['experience']);
        }

        if (!empty($rawData['schedule']) && !empty($rawData['schedule']['id'])) {
            $this->schedule = $this->prepareRelation(Schedule::class, $rawData['schedule']);
        }

        if (!empty($rawData['employment']) && !empty($rawData['employment']['id'])) {
            $this->employment = $this->prepareRelation(Employment::class, $rawData['employment']);
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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getPreparedDescription(): ?string
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

    /**
     * @return bool
     */
    public function isAcceptedKids(): bool
    {
        return $this->isAcceptedKids;
    }

    /**
     * @return bool
     */
    public function isAcceptedHandicapped(): bool
    {
        return $this->isAcceptedHandicapped;
    }

    /**
     * @return Schedule|null
     */
    public function getSchedule(): ?Schedule
    {
        return $this->schedule;
    }

    /**
     * @return Employment|null
     */
    public function getEmployment(): ?Employment
    {
        return $this->employment;
    }
}
