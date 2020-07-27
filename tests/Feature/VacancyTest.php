<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Client;
use ArtARTs36\HeadHunterApi\Features\Vacancy\Query;
use ArtARTs36\HeadHunterApi\Features\Vacancy\Vacancy;
use ArtARTs36\HeadHunterApi\Tests\Traits\CallMethodViaReflection;
use PHPUnit\Framework\TestCase;

class VacancyTest extends TestCase
{
    use CallMethodViaReflection;

    public function testQuery(): void
    {
        $id = 123;

        $query = (new Query())->addCompany($id);

        self::assertEquals($query->params()[0][Query::EMPLOYER_ID], $id);

        //

        $twoId = 456;

        $query->addCompany($twoId);

        $expected = [
            [Query::EMPLOYER_ID => $id],
            [Query::EMPLOYER_ID => $twoId],
        ];

        self::assertEquals($query->params(), $expected);

        //

        $client = new Client('https://api.hh.ru', "User-Agent: MyApp/temicska99@mail.ru");

        $feature = new Vacancy($client);

        $featureUrl = $this->callMethodViaReflection($feature, 'urlOfQuery', $query);

        self::assertEquals('vacancies?employer_id=123&employer_id=456', $featureUrl);

        //
    }
}
