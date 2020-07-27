<?php

namespace ArtARTs36\HeadHunterApi\Support\Feature;

use ArtARTs36\HeadHunterApi\Contracts\Client;

trait WithClient
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
