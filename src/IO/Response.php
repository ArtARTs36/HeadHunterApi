<?php

namespace ArtARTs36\HeadHunterApi\IO;

class Response
{
    private $code;

    private $content;

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

    public function content()
    {
        return $this->content;
    }

    public function toArray(): ?array
    {
        return json_decode($this->content);
    }
}
