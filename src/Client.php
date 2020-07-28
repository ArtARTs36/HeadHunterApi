<?php

namespace ArtARTs36\HeadHunterApi;

use ArtARTs36\HeadHunterApi\Contracts\Client as ClientContract;
use ArtARTs36\HeadHunterApi\Exceptions\ExceptionHandler;
use ArtARTs36\HeadHunterApi\Exceptions\SendRequestException;
use ArtARTs36\HeadHunterApi\IO\Request;

/**
 * Class Client
 * @package ArtARTs36\HeadHunterApi
 */
class Client implements ClientContract
{
    public const ALLOWED_HTTP_CODES = [200, 201];

    protected $baseUrl;

    protected $userAgent;

    protected $exceptionHandler;

    /**
     * Client constructor.
     * @param string $url
     * @param string $userAgent
     * @param ExceptionHandler|null $exceptionHandler
     */
    public function __construct(string $url, string $userAgent, ExceptionHandler $exceptionHandler = null)
    {
        $this->baseUrl = $url;
        $this->userAgent = $userAgent;
        $this->exceptionHandler = $exceptionHandler ?? new ExceptionHandler();
    }

    /**
     * @param string $url
     * @return array
     * @throws SendRequestException
     */
    public function get(string $url): array
    {
        return $this->send(Request::METHOD_GET, $url);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array|null $params
     * @return array
     * @throws SendRequestException
     */
    protected function send(string $method, string $url, array $params = null): array
    {
        $request = $this->createRequest($url);

        if ($method !== Request::METHOD_GET) {
            $request->setMethod($method);
        }

        if (!empty($params)) {
            $request->setParams($params);
        }

        $response = $request->execute();

        if (!$this->isAllowedHttpCode($response->code())) {
            $this->exceptionHandler->handle($response);
        }

        return $response->toArray();
    }

    /**
     * @param string $url
     * @return string
     */
    protected function url(string $url): string
    {
        return $this->baseUrl . DIRECTORY_SEPARATOR . $url;
    }

    /**
     * @param $code
     * @return bool
     */
    final protected function isAllowedHttpCode($code): bool
    {
        return in_array($code, static::ALLOWED_HTTP_CODES);
    }

    /**
     * @param string $url
     * @return Request
     */
    protected function createRequest(string $url): Request
    {
        return new Request($this->url($url), $this->userAgent);
    }
}
