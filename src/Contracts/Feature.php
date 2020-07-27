<?php

namespace ArtARTs36\HeadHunterApi\Contracts;

use ArtARTs36\HeadHunterApi\BasedQuery;

/**
 * Interface Feature
 * @package ArtARTs36\HeadHunterApi\Contracts
 */
interface Feature
{
    /**
     * @param Query $query
     * @return mixed
     */
    public function executeQuery(Query $query);
}
