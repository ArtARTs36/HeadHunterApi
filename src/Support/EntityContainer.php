<?php

namespace ArtARTs36\HeadHunterApi\Support;

use ArtARTs36\HeadHunterApi\Contracts\Entity;

/**
 * Class EntityContainer
 * @package ArtARTs36\HeadHunterApi\Support
 */
final class EntityContainer
{
    /** @var array */
    private static $container = [];

    /**
     * @param string $type
     * @param mixed $id
     * @return Entity|null
     */
    public static function get($type, $id): ?Entity
    {
        if (empty(static::$container[$type])) {
            return null;
        }

        return static::$container[$type][$id] ?? null;
    }

    /**
     * @param string $type
     * @param mixed $id
     * @param Entity $entity
     * @return Entity
     */
    public static function set($type, $id, Entity $entity): Entity
    {
        static::$container[$type][$id] = $entity;

        return $entity;
    }

    /**
     * @param string $type
     * @param mixed $id
     * @param \Closure $setter
     * @return Entity
     */
    public static function remember($type, $id, \Closure $setter): Entity
    {
        return static::get($type, $id) ?? static::set($type, $id, $setter());
    }
}
