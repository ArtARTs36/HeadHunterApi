<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit\Entities;

use ArtARTs36\HeadHunterApi\Entities\Vacancy;
use ArtARTs36\HeadHunterApi\Tests\TestCase;

/**
 * Class VacancyTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit\Entities
 */
final class VacancyTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Vacancy
     */
    public function testCreateInstance(): void
    {
        $data = [
            'id' => $id = '15',
            'area' => $this->getAreaData(),
            'published_at' => $publishedAt = '2020-09-08',
            'salary' => $salary = '10000000 rub',
            'alternate_url' => $url = 'http://hh.ru/',
        ];

        $vacancy = new Vacancy($data);

        self::assertEquals(15, $vacancy->getId());
        self::assertFalse($vacancy->isAcceptedKids());
        self::assertFalse($vacancy->isAcceptedHandicapped());
        self::assertNull($vacancy->getExperience());
        self::assertFalse($vacancy->hasTestTask());
        self::assertNull($vacancy->getDescription());
        self::assertNotNull($vacancy->getArea());
        self::assertEquals($salary, $vacancy->getSalary());
        self::assertEquals($publishedAt, $vacancy->getPublishedAt());
        self::assertEquals($id, $vacancy->getId());
        self::assertEquals($url, $vacancy->getWebUrl());
        self::assertNull($vacancy->getSpecializations());
        self::assertNull($vacancy->getSkillsNames());
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Vacancy::getPreparedDescription
     */
    public function testGetPreparedDescription(): void
    {
        $data = [
            'id' => $id = '15',
            'area' => $this->getAreaData(),
            'published_at' => $publishedAt = '2020-09-08',
            'salary' => $salary = '10000000 rub',
            'alternate_url' => $url = 'http://hh.ru/',
            'description' => $description = '<br />Hello, <li>Artem'
        ];

        $vacancy = new Vacancy($data);

        self::assertEquals('Hello, 
Artem', $vacancy->getPreparedDescription());
    }

    private function getAreaData(): array
    {
        return [
            'id' => 1,
            'name' => 'Russia',
        ];
    }
}
