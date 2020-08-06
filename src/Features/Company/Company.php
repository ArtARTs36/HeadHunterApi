<?php

namespace ArtARTs36\HeadHunterApi\Features\Company;

use ArtARTs36\HeadHunterApi\Contracts\Feature;
use ArtARTs36\HeadHunterApi\Contracts\Query;
use ArtARTs36\HeadHunterApi\Entities\Company as CompanyEntity;
use ArtARTs36\HeadHunterApi\Support\Collection;
use ArtARTs36\HeadHunterApi\Support\Feature\WithClient;
use ArtARTs36\HeadHunterApi\Support\ParamsUrl;

class Company implements Feature
{
    use WithClient;

    const URL = 'employers';

    /**
     * @inheritDoc
     */
    public function executeQuery(Query $query)
    {
        $response = $this->client->get($this->urlOfQuery($query));

        return new Collection(
            array_map(function ($item) {
                return new CompanyEntity($item);
            }, $response['items']),
            $response['found'] ?? null,
            $response['pages'] ?? null,
            $response['page'] ?? null
        );
    }

    /**
     * @param Query $query
     * @return string
     */
    protected function urlOfQuery(Query $query): string
    {
        return static::URL . '?'. ParamsUrl::convert($query->params());
    }
}
