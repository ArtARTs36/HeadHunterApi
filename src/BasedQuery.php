<?php

namespace ArtARTs36\HeadHunterApi;

/**
 * Class BasedQuery
 * @package ArtARTs36\HeadHunterApi
 */
abstract class BasedQuery
{
    /**
     * @var array
     */
    protected $params;

    /**
     * @param mixed $key
     * @param mixed $value
     * @return static
     */
    final protected function addParam($key, $value): self
    {
        $this->params[] = [
            $key => $value
        ];

        return $this;
    }

    /**
     * @return array
     */
    public function params(): array
    {
        return $this->params;
    }

    /**
     * @param mixed $key
     * @return bool
     */
    public function hasParam($key): bool
    {
        return !empty($this->params[$key]);
    }
}
