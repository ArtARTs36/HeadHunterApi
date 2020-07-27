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
    public const SALARY = 'salary';
    public const ONLY_WITH_SALARY = 'only_with_salary';
    public const PREMIUM = 'premium';

    /**
     * @param int $id
     * @return $this
     */
    public function addCompany(int $id): self
    {
        return $this->addParam(static::EMPLOYER_ID, $id);
    }

    /**
     * @param int $salary
     * @return $this
     */
    public function whereSalary(int $salary): self
    {
        return $this->addParam(static::SALARY, $salary);
    }

    /**
     * @return $this
     */
    public function onlyWithSalary(): self
    {
        return $this->addParam(static::ONLY_WITH_SALARY, true);
    }

    /**
     * @return $this
     */
    public function onlyPremium(): self
    {
        return $this->addParam(static::PREMIUM, true);
    }
}
