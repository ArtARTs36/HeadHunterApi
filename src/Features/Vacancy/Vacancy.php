<?php

namespace ArtARTs36\HeadHunterApi\Features\Vacancy;

use ArtARTs36\HeadHunterApi\Contracts\Feature;
use ArtARTs36\HeadHunterApi\Contracts\Query;
use ArtARTs36\HeadHunterApi\Support\Collection;
use ArtARTs36\HeadHunterApi\Support\Feature\WithClient;
use ArtARTs36\HeadHunterApi\Support\ParamsUrl;
use ArtARTs36\HeadHunterApi\Entities\Vacancy as VacancyEntity;

/**
 * Class Vacancy
 * @package ArtARTs36\HeadHunterApi\Features\Vacancy
 */
class Vacancy implements Feature
{
    use WithClient;

    const URL = 'vacancies';

    /**
     * @param Query $query
     * @return Collection|VacancyEntity[]
     */
    public function executeQuery(Query $query)
    {
        $response = $this->client->get($this->urlOfQuery($query));

        return new Collection(
            array_map(function ($item) {
                return new VacancyEntity($item);
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

    /**
     * @param int $id
     * @return VacancyEntity
     */
    public function find(int $id): VacancyEntity
    {
        return new VacancyEntity($this->client->get(static::URL . DIRECTORY_SEPARATOR . $id));
    }
}
