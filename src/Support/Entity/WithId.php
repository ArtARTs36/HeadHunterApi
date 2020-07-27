<?php

namespace ArtARTs36\HeadHunterApi\Support\Entity;

trait WithId
{
    private $id;

    public function getId(): int
    {
        return $this->id;
    }
}
