<?php

namespace ArtARTs36\HeadHunterApi\Support;

use ArtARTs36\HeadHunterApi\Contracts\Entity;

class EntityContainer
{
    private static $container;

    public static function get($type, $id): ?Entity
    {
        if (empty(static::$container[$type])) {
            return null;
        }

        return static::$container[$type][$id] ?? null;
    }

    public static function set($type, $id, Entity $entity): void
    {
        static::$container[$type][$id] = $entity;
    }

    public static function remember($type, $id, \Closure $setter): Entity
    {
        return static::get($type, $id) ?? $setter();
    }
}
