<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\IO\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ResponseTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
class ResponseTest extends TestCase
{
    /**
     * @covers \ArtARTs36\HeadHunterApi\IO\Response
     */
    public function test()
    {
        $code = 5;

        $response = new Response($code, null);

        self::assertEquals($code, $response->code());
        self::assertNull($response->toArray());
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\IO\Response::toArray
     * @covers \ArtARTs36\HeadHunterApi\IO\Response::content
     */
    public function testToArray()
    {
        $response = new Response(1, 5);

        self::assertEquals([5], $response->toArray());
        self::assertEquals(5, $response->content());

        //

        $response = new Response(1, 5.1);

        self::assertEquals([5.1], $response->toArray());
        self::assertEquals(5.1, $response->content());

        //

        $response = new Response(1, 'test');

        self::assertEquals(['test'], $response->toArray());
        self::assertEquals('test', $response->content());

        //

        $response = new Response(1, '{"key":"value"}');

        self::assertEquals($mock = ['key' => 'value'], $response->toArray());
        self::assertEquals('{"key":"value"}', $response->content());

        //

        $response = new Response(1, $mock);

        self::assertEquals($mock, $response->toArray());
        self::assertEquals($mock, $response->content());
    }
}
