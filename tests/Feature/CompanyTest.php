<?php

namespace ArtARTs36\HeadHunterApi\Tests\Feature;

use ArtARTs36\HeadHunterApi\Features\Company\Query;
use PHPUnit\Framework\TestCase;

final class CompanyTest extends TestCase
{
    public function testQuery()
    {
        $query = new Query();

        self::assertEmpty($query->params());

        $query
            ->onlyWithVacancies()
            ->whereNameOrDescription('mega company');

        self::assertTrue($query->hasParam('only_with_vacancies'));
        self::assertTrue($query->hasParam('text'));

        self::assertEquals([
            [
                'only_with_vacancies' => true,
            ],
            [
                'text' => 'mega company',
            ],
        ], $query->params());

        //
    }
}
