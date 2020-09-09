<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit\Entities;

use ArtARTs36\HeadHunterApi\Entities\Company;
use ArtARTs36\HeadHunterApi\Tests\TestCase;

final class CompanyTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\Entities\Company
     */
    public function testCreateInstance(): void
    {
        $data = [
            'id' => $id = 5,
            'name' => $name = 'Mega Company',
            'alternate_url' => $url = 'https://hh.ru',
            'open_vacancies' => $vacancies = 5,
        ];

        $company = new Company($data);

        self::assertEquals($data, $company->getRawData());
        self::assertEquals($id, $company->getId());
        self::assertEquals($name, $company->getName());
        self::assertEquals($url, $company->getWebUrl());
        self::assertEquals($vacancies, $company->getOpenVacanciesCount());
        self::assertEquals(null, $company->getVacanciesUrl());
    }
}
