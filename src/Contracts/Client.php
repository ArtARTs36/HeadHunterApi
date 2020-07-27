<?php

namespace ArtARTs36\HeadHunterApi\Contracts;

/**
 * Interface Client
 * @package ArtARTs36\HeadHunterApi\Contracts
 */
interface Client
{
    /**
     * @param string $url
     * @return array
     */
    public function get(string $url): array;
}
