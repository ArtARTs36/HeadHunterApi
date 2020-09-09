<?php

namespace ArtARTs36\HeadHunterApi\Support\Entity;

trait WithBooleans
{
    /**
     * @param string $key
     * @param bool $default
     * @return bool
     */
    protected function prepareBoolean(string $key, bool $default = false): bool
    {
        return isset($this->rawData[$key]) ? (bool) $this->rawData[$key] : $default;
    }
}
