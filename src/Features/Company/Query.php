<?php

namespace ArtARTs36\HeadHunterApi\Features\Company;

use ArtARTs36\HeadHunterApi\BasedQuery;
use ArtARTs36\HeadHunterApi\Contracts\Query as QueryContract;
use ArtARTs36\HeadHunterApi\Support\WithPaginate;

class Query extends BasedQuery implements QueryContract
{
    use WithPaginate;

    /**
     * @param string $text - name or description
     * @return $this
     */
    public function whereNameOrDescription(string $text): self
    {
        return $this->addParam('text', $text);
    }

    /**
     * @return $this
     */
    public function onlyWithVacancies(): self
    {
        return $this->addParam('only_with_vacancies', true);
    }
}
