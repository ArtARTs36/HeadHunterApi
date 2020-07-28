<?php

namespace ArtARTs36\HeadHunterApi\IO;

class Request
{
    public const METHOD_GET = 'GET';

    private $curl;

    private $uri;

    private $method;

    public function __construct(string $uri, string $userAgent, string $method = self::METHOD_GET)
    {
        $this->curl = curl_init();
        $this->uri = $uri;

        curl_setopt($this->curl, CURLOPT_HEADER, false);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            "User-Agent: {$userAgent}",
        ]);

        $this->method = $method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function setParams(array $params)
    {
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);

        return $this;
    }

    public function execute()
    {
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, $this->method);

        $response = curl_exec($this->curl);

        $code = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);

        curl_close($this->curl);

        return new Response($code, $response);
    }
}
