<?php

namespace ArtARTs36\HeadHunterApi;

use ArtARTs36\HeadHunterApi\Contracts\Client as ClientContract;
use ArtARTs36\HeadHunterApi\Exceptions\ExceptionHandler;
use ArtARTs36\HeadHunterApi\Exceptions\SendRequestException;

/**
 * Class Client
 * @package ArtARTs36\HeadHunterApi
 */
class Client implements ClientContract
{
    public const METHOD_GET = 'GET';
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
        return $this->send(static::METHOD_GET, $url);
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
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url($url));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "User-Agent: {$this->userAgent}",
        ]);

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method !== static::METHOD_GET) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        $response = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if (!in_array($httpCode, static::ALLOWED_HTTP_CODES)) {
            $this->exceptionHandler->handle($response);
        }

        return json_decode($response, true);
    }

    /**
     * @param string $url
     * @return string
     */
    protected function url(string $url): string
    {
        return $this->baseUrl . DIRECTORY_SEPARATOR . $url;
    }
}
