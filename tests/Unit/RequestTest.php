<?php

namespace ArtARTs36\HeadHunterApi\Tests\Unit;

use ArtARTs36\HeadHunterApi\Exceptions\RequestMethodNotAllowed;
use ArtARTs36\HeadHunterApi\IO\Request;
use ArtARTs36\HeadHunterApi\Tests\Traits\CallMethodViaReflection;
use PHPUnit\Framework\TestCase;

/**
 * Class RequestTest
 * @package ArtARTs36\HeadHunterApi\Tests\Unit
 */
final class RequestTest extends TestCase
{
    use CallMethodViaReflection;

    /**
     * @covers \ArtARTs36\HeadHunterApi\IO\Request::setMethod
     * @covers \ArtARTs36\HeadHunterApi\IO\Request::method
     */
    public function testSetMethod()
    {
        $request = new Request('', '');

        //

        $request->setMethod(Request::METHOD_GET);

        self::assertEquals(Request::METHOD_GET, $request->method());

        //

        self::expectException(RequestMethodNotAllowed::class);

        $request->setMethod('random_string');
    }

    /**
     * @covers \ArtARTs36\HeadHunterApi\IO\Request::isMethodAllowed
     */
    public function testIsMethodAllowed()
    {
        $request = new Request('', '');

        $checker = function ($method) use ($request) {
            return $this->callMethodViaReflection($request, 'isMethodAllowed', $method);
        };

        self::assertTrue($checker(Request::METHOD_GET));
        self::assertFalse($checker('random_string'));
    }
}
