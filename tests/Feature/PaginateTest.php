<?php

namespace ArtARTs36\HeadHunterApi\Tests\Feature;

use ArtARTs36\HeadHunterApi\BasedQuery;
use ArtARTs36\HeadHunterApi\Contracts\Feature;
use ArtARTs36\HeadHunterApi\Contracts\Query;
use ArtARTs36\HeadHunterApi\Support\ParamsUrl;
use ArtARTs36\HeadHunterApi\Support\WithPaginate;
use PHPUnit\Framework\TestCase;

final class PaginateTest extends TestCase
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
                return ParamsUrl::convert($query->params());
            }
        };

        self::assertEquals("page={$page}&per_page={$count}", $feature->executeQuery($query));
    }
}
