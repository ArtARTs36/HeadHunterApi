<?php

namespace ArtARTs36\HeadHunterApi\Features\Vacancy;

use ArtARTs36\HeadHunterApi\BasedQuery;
use ArtARTs36\HeadHunterApi\Support\WithPaginate;

class Query extends BasedQuery implements \ArtARTs36\HeadHunterApi\Contracts\Query
{
    use WithPaginate;

    public const EMPLOYER_ID = 'employer_id';

    public function addCompany(int $id): self
    {
        return $this->addParam(static::EMPLOYER_ID, $id);
    }
}
