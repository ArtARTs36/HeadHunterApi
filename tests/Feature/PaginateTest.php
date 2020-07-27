<?php

namespace ArtARTs36\HeadHunterApi\Tests\Feature;

use ArtARTs36\HeadHunterApi\BasedQuery;
use ArtARTs36\HeadHunterApi\Contracts\Feature;
use ArtARTs36\HeadHunterApi\Contracts\Query;
use ArtARTs36\HeadHunterApi\ParamsUrl;
use ArtARTs36\HeadHunterApi\Support\WithPaginate;
use PHPUnit\Framework\TestCase;

class PaginateTest extends TestCase
{
    public function test(): void
    {
        $page = 5;
        $count = 10;

        //

        $query = new class extends BasedQuery implements Query {
            use WithPaginate;
        };

        $query
            ->page($page)
            ->count($count);

        //

        $feature = new class implements Feature {
            public function executeQuery(Query $query)
            {
                return ParamsUrl::create($query->params());
            }
        };

        self::assertEquals('page=5&per_page=10', $feature->executeQuery($query));
    }
}
