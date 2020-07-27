<?php

namespace ArtARTs36\HeadHunterApi\Contracts;

/**
 * Interface Query
 * @package ArtARTs36\HeadHunterApi\Contracts
 */
interface Query
{
    /**
     * @return array
     */
    public function params(): array;

    /**
     * @param mixed $key
     * @return bool
     */
    public function hasParam($key): bool;
}
