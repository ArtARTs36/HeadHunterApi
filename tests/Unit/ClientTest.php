<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Client;
use ArtARTs36\HeadHunterApi\Tests\Traits\CallMethodViaReflection;
use PHPUnit\Framework\TestCase;

/**
 * Class ClientTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
class ClientTest extends TestCase
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

    protected function make(): Client
    {
        return new Client(
            'https://api.hh.ru',
            'MyApp/my@mail.ru'
        );
    }
}
