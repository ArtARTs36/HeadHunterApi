<?php

namespace ArtARTs36\HeadHunterApi;

class ParamsUrl
{
    protected $params;

    protected $url;

    public function __construct(array $params)
    {
        $this->params = $params;
        $this->url = '';
    }

    public static function create(array $params): string
    {
        return (new static($params))->to();
    }

    public function to(): string
    {
        array_walk_recursive($this->params, function ($value, $key) {
            $this->add($key, $value);
        });

        return $this->url;
    }

    protected function add($key, $value)
    {
        if (!empty($this->url)) {
            $this->url .= '&';
        }

        $this->url .= "{$key}={$value}";
    }
}
