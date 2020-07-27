<?php

namespace ArtARTs36\HeadHunterApi;

use ArtARTs36\HeadHunterApi\Contracts\Client as ClientContract;

/**
 * Class Client
 * @package ArtARTs36\HeadHunterApi
 */
class Client implements ClientContract
{
    public const METHOD_GET = 'GET';

    protected $baseUrl;

    protected $userAgent;

    /**
     * Client constructor.
     * @param string $url
     * @param string $userAgent
     */
    public function __construct(string $url, string $userAgent)
    {
        $this->baseUrl = $url;
        $this->userAgent = $userAgent;
    }

    /**
     * @param string $url
     * @return array
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
     */
    protected function send(string $method, string $url, array $params = null): array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url($url));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "User-Agent: MyApp/temicska99@mail.ru",
        ]);

        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($method !== static::METHOD_GET) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        }

        $response = curl_exec($ch);

        curl_close($ch);

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
