<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Client;
use ArtARTs36\HeadHunterApi\Exceptions\ExceptionHandler;
use ArtARTs36\HeadHunterApi\IO\Request;
use ArtARTs36\HeadHunterApi\IO\Response;
use ArtARTs36\HeadHunterApi\Tests\Traits\CallMethodViaReflection;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class ClientTest extends TestCase
{
    use CallMethodViaReflection;

    private const BASE_URL = 'https://api.hh.ru';

    /**
     * @covers \ArtARTs36\HeadHunterApi\Client::url
     */
    public function testUrl(): void
    {
        $url = 'companies/'. rand(1, 99);

        self::assertEquals(static::BASE_URL . DIRECTORY_SEPARATOR . $url, $this->callMethodViaReflection(
            $this->make(),
            'url',
            $url
        ));
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Client::isAllowedHttpCode
     */
    public function testIsAllowedHttpCode(): void
    {
        $client = $this->make();

        $checker = function ($code) use ($client) {
            return $this->callMethodViaReflection($client, 'isAllowedHttpCode', $code);
        };

        self::assertTrue($checker(200));
        self::assertTrue($checker(201));
        self::assertFalse($checker(403));
        self::assertFalse($checker(404));
        self::assertFalse($checker(409));
        self::assertFalse($checker(421));
        self::assertFalse($checker(500));
        self::assertFalse($checker(501));
        self::assertFalse($checker(501));
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\Client
     */
    public function testSend(): void
    {
        $request = new class('https://api.hh.ru/vacancies/1', 'MyApp/my@mail.ru') extends Request {
            public function execute(): Response
            {
                return new Response(200, '[]');
            }
        };

        $client = new class('https://api.hh.ru', 'MyApp/my@mail.ru', $request) extends Client {
            private $request;

            public function __construct(
                string $url,
                string $userAgent,
                Request $request,
                ExceptionHandler $exceptionHandler = null
            ) {
                parent::__construct($url, $userAgent, $exceptionHandler);

                $this->request = $request;
            }

            protected function createRequest(string $url): Request
            {
                return $this->request;
            }
        };

        $client->get('https://api.hh.ru/vacancies/1');

        self::assertEquals(Request::METHOD_GET, $request->method());
    }

    /**
     * @throws \ReflectionException
     */
    public function testCreateRequest(): void
    {
        $client = $this->make();

        /** @var Request $request */
        $request = $this->callMethodViaReflection($client, 'createRequest', 'vacancies/1');

        self::assertEquals('https://api.hh.ru/vacancies/1', $request->uri());
    }

    protected function make(): Client
    {
        return new Client(
            'https://api.hh.ru',
            'MyApp/my@mail.ru'
        );
    }
}
