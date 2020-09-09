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
            'id' => '15',
            'area' => [
                'id' => 1,
                'name' => 'Russia',
            ],
            'published_at' => '2020-09-08',
            'salary' => '10000000 rub',
            'alternate_url' => 'http://hh.ru/',
        ];

        $vacancy = new Vacancy($data);

        self::assertEquals(15, $vacancy->getId());
    }
}
