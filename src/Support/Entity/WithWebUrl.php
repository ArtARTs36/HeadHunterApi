<?php

namespace ArtARTs36\HeadHunterApi\Support\Entity;

trait WithWebUrl
{
    /** @var string */
    private $webUrl;

    /**
     * @return string
     */
    public function getWebUrl(): string
    {
        return $this->webUrl;
    }
}
