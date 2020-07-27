<?php

namespace ArtARTs36\HeadHunterApi\Features\Vacancy;

use ArtARTs36\HeadHunterApi\BasedQuery;
use ArtARTs36\HeadHunterApi\Support\WithPaginate;
use ArtARTs36\HeadHunterApi\Contracts\Query as QueryContract;

/**
 * Class Query
 * @package ArtARTs36\HeadHunterApi\Features\Vacancy
 */
class Query extends BasedQuery implements QueryContract
{
    use WithPaginate;

    public const EMPLOYER_ID = 'employer_id';

    /**
     * @param int $id
     * @return $this
     */
    public function addCompany(int $id): self
    {
        return $this->addParam(static::EMPLOYER_ID, $id);
    }
}
