<?php

namespace ArtARTs36\HeadHunterApi\Contracts;

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
