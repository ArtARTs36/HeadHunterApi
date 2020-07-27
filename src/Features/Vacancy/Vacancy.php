<?php

namespace ArtARTs36\HeadHunterApi\Features\Vacancy;

use ArtARTs36\HeadHunterApi\Contracts\Client;
use ArtARTs36\HeadHunterApi\Contracts\Feature;
use ArtARTs36\HeadHunterApi\Contracts\Query;
use ArtARTs36\HeadHunterApi\Support\ParamsUrl;
use ArtARTs36\HeadHunterApi\Entities\Vacancy as VacancyEntity;

/**
 * Class Vacancy
 * @package ArtARTs36\HeadHunterApi\Features\Vacancy
 */
class Vacancy implements Feature
{
    public const URL = 'vacancies';

    /**
     * @var Client
     */
    protected $client;

    /**
     * Vacancy constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param Query $query
     * @return array|mixed
     */
    public function executeQuery(Query $query)
    {
        $response = $this->client->get($this->urlOfQuery($query));

        return array_map(function ($item) {
            return new VacancyEntity($item);
        }, $response['items']);
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
