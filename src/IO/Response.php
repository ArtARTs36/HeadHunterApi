<?php

namespace ArtARTs36\HeadHunterApi\IO;

/**
 * Class Response
 * @package ArtARTs36\HeadHunterApi\IO
 */
class Response
{
    /** @var int */
    private $code;

    /** @var mixed raw content*/
    private $content;

    /**
     * Response constructor.
     * @param int $code
     * @param mixed $content
     */
    public function __construct(int $code, $content)
    {
        $this->code = $code;
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function code(): int
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function content()
    {
        return $this->content;
    }

    /**
     * @return array|null
     */
    public function toArray(): ?array
    {
        if (empty($this->content)) {
            return null;
        }

        if (is_array($this->content)) {
            return $this->content;
        }

        if (is_string($this->content)) {
            return json_decode($this->content, true) ?? [$this->content];
        }

        return [$this->content];
    }
}
