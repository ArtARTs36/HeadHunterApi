<?php

namespace ArtARTs36\HeadHunterApi\Support;

class Collection implements \ArrayAccess, \Countable, \IteratorAggregate
{
    protected $maxCount;

    protected $page;

    protected $maxPage;

    protected $items;

    public function __construct(array $items, ?int $maxCount, ?int $maxPage = 0, ?int $page = 0)
    {
        $this->items = $items;
        $this->maxCount = $maxCount ?? $this->count();
        $this->page = $page;
        $this->maxPage = $maxPage;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return empty($this->items[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        unset($this->items[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @return int
     */
    public function maxCount(): int
    {
        return $this->maxCount;
    }

    /**
     * @return int
     */
    public function page(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function maxPage(): int
    {
        return $this->maxPage;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return $this->items[@array_key_first($this->items) ?? 0];
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->items);
    }
}
