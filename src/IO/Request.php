<?php

namespace ArtARTs36\HeadHunterApi\IO;

use ArtARTs36\HeadHunterApi\Exceptions\RequestMethodNotAllowed;
use ArtARTs36\HeadHunterApi\Exceptions\SendRequestException;

/**
 * Class Request
 * @package ArtARTs36\HeadHunterApi\IO
 */
class Request
{
    const METHOD_GET = 'GET';

    const ALLOWED_METHODS = [
        self::METHOD_GET,
    ];

    /** @var false|resource */
    protected $curl;

    /** @var string */
    private $uri;

    /** @var string */
    private $method;

    /**
     * Request constructor.
     * @param string $uri
     * @param string $userAgent
     * @param string $method
     */
    public function __construct(string $uri, string $userAgent, string $method = self::METHOD_GET)
    {
        $this->curl = curl_init();
        $this->uri = $uri;

        curl_setopt($this->curl, CURLOPT_HEADER, false);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            "User-Agent: {$userAgent}",
        ]);

        $this->setMethod($method);
    }

    /**
     * @param string $method
     * @return $this
     */
    public function setMethod(string $method): self
    {
        if (!$this->isMethodAllowed($method)) {
            throw new RequestMethodNotAllowed($method);
        }

        $this->method = $method;

        return $this;
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setParams(array $params)
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);

        return $this;
    }

    /**
     * @return string
     */
    public function uri(): string
    {
        return $this->uri;
    }

    /**
     * @return Response
     * @throws SendRequestException
     */
    public function execute(): Response
    {
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $this->method);

        curl_setopt($this->curl, CURLOPT_URL, $this->uri);

        $response = curl_exec($this->curl);

        $code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        if (($error = curl_error($this->curl)) && (!empty($this->curl))) {
            throw new SendRequestException($error);
        }

        curl_close($this->curl);

        return new Response($code, $response);
    }

    /**
     * @param string $method
     * @return bool
     */
    final protected function isMethodAllowed(string $method): bool
    {
        return in_array($method, static::ALLOWED_METHODS);
    }
}
