<?php

namespace ArtARTs36\HeadHunterApi\Support;

class ParamsUrl
{
    /** @var array */
    protected $params;

    /** @var string */
    protected $url;

    /**
     * ParamsUrl constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->params = $params;
        $this->url = '';
    }

    /**
     * @param array $params
     * @return string
     */
    public static function convert(array $params): string
    {
        return (new static($params))->to();
    }

    /**
     * @return string
     */
    public function to(): string
    {
        array_walk_recursive($this->params, function ($value, $key) {
            $this->add($key, $value);
        });

        return $this->url;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    protected function add(string $key, $value)
    {
        if (!empty($this->url)) {
            $this->url .= '&';
        }

        $this->url .= "{$key}={$value}";
    }
}
