<?php

namespace ArtARTs36\HeadHunterApi\Support;

trait WithPaginate
{
    public function page(int $page): self
    {
        return $this->addParam('page', $page);
    }

    public function count(int $count): self
    {
        return $this->addParam('per_page', $count);
    }
}
