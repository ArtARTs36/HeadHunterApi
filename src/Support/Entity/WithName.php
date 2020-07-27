<?php

namespace ArtARTs36\HeadHunterApi\Support\Entity;

trait WithName
{
    private $name;

    public function getName(): string
    {
        return $this->name;
    }
}
