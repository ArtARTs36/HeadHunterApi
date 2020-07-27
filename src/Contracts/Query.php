<?php

namespace ArtARTs36\HeadHunterApi\Contracts;

/**
 * Interface Query
 * @package ArtARTs36\HeadHunterApi\Contracts
 */
interface Query
{
    public function params(): array;

    public function hasParam($key): bool;
}
